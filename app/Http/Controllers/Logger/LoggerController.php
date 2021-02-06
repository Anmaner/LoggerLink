<?php

namespace App\Http\Controllers\Logger;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DefaultRender;
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
    use DefaultRender;

    protected $request;
    protected $service;
    protected $followService;
    protected $carbon;

    public function __construct(Request $request, LoggerService $service, FollowService $followService, Carbon $carbon)
    {
        $this->request = $request;
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
        $loggers = $this->renderLoggers($this->request);

        return view('logger.information', compact('loggers', 'logger'));
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

        $loggers = $this->renderLoggers($request);

        return view('logger.statistics', compact('logger', 'follows', 'loggers'));
    }

    public function export(Logger $logger)
    {
        $loggers = $this->renderLoggers($this->request);

        return view('logger.export', compact('loggers', 'logger'));
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

    public function follow(Logger $logger, GuestResolverInterface $resolver, Browser $browser, Os $os, Request $request)
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
