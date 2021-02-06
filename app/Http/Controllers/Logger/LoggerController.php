<?php

namespace App\Http\Controllers\Logger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Logger\LoggerRequest;
use App\Models\Logger\Follow;
use App\Services\FollowService;
use App\Services\LoggerService;
use App\UseCases\GuestResolver\GuestResolverInterface;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Logger\Logger;
use Illuminate\Support\Facades\Storage;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Os;

class LoggerController extends Controller
{
    protected $service;
    protected $followService;
    protected $carbon;

    public function __construct(LoggerService $service, FollowService $followService, Carbon $carbon)
    {
        $this->service = $service;
        $this->followService = $followService;
        $this->carbon = $carbon;
    }

    public function generate()
    {
        $token = $this->service->generate();

        return redirect()->route('logger.information', $token);
    }

    public function information(Logger $logger)
    {
        return view('logger.information', compact('logger'));
    }

    public function informationStore(Logger $logger, LoggerRequest $request)
    {
        $logger->update([
            'redirect' => $request->get('redirect'),
            'code' => $request->get('code'),
            'status' => $request->get('status')
        ]);

        return back()->with('success', 'Information is successfully updated.');
    }

    public function statistics(Logger $logger, Request $request, Follow $follow)
    {
        try {
            $follows = $this->service->selectFollowStatistics(
                $logger->id,
                $request->get('first_date'),
                $request->get('second_date'),
                $request->get('unique')
            );
        } catch (InvalidFormatException $e) {
            return back()->with('error', 'Invalid date format given.');
        }

        return view('logger.statistics', compact('logger', 'follows'));
    }

    public function export(Logger $logger)
    {
        return view('logger.export', compact('logger'));
    }

    public function exportDownload(Logger $logger, Request $request)
    {
        try {
            $follows = $this->service->selectFollowStatistics(
                $logger->id,
                $request->get('first_date'),
                $request->get('second_date'),
                $request->get('unique')
            );

            $statistics = $this->service->generateExportStatistics(
                $follows,
                $request->get('type'),
                array_keys ($request->all())
            );

            $fileDir = $this->service->loadStatisticsToFile(
                $logger->id,
                $request->get('type'),
                $statistics
            );
        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return Storage::download($fileDir);
    }

    public function follow(Logger $logger, Request $request, GuestResolverInterface $resolver, Browser $browser, Os $os)
    {
        try {
            $this->followService->follow(
                $resolver,
                $request->ip(),
                $logger->id,
                $request->server('HTTP_REFERER') ?? '',
            );
        } catch (\DomainException $e) {
            abort(404);
        }

        if($logger->redirect) {
            return redirect($logger->redirect);
        } else {
            abort(404);
        }
    }
}
