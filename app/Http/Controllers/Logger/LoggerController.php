<?php

namespace App\Http\Controllers\Logger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Logger\LoggerRequest;
use App\Models\Logger\Follow;
use App\Services\LoggerService;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Logger\Logger;

class LoggerController extends Controller
{
    protected $service;
    protected $carbon;

    public function __construct(LoggerService $service, Carbon $carbon)
    {
        $this->service = $service;
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
            $follows = $this->service->selectStatistics(
                $logger,
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

    public function exportDownload()
    {
        //
    }
}
