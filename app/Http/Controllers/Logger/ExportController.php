<?php

namespace App\Http\Controllers\Logger;

use App\Http\Controllers\DefaultRender;
use App\Models\Logger\Logger;
use App\Services\Logger\LoggerService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExportController
{
    use DefaultRender;

    protected $service;
    protected $request;

    public function __construct(LoggerService $service, Request $request)
    {
        $this->service = $service;
        $this->request = $request;
    }

    public function formLogger(Logger $logger)
    {
        return $this->form($logger, 'logger');
    }

    public function formShortener(Logger $logger)
    {
        return $this->form($logger, 'shortener');
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

    protected function form(Logger $logger, String $type)
    {
        $loggers = $this->renderLoggers($this->request);

        return view("$type.export", compact('loggers', 'logger'));
    }
}
