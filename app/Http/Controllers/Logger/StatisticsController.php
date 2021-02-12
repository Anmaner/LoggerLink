<?php

namespace App\Http\Controllers\Logger;

use App\Http\Controllers\DefaultRender;
use App\Models\Logger\Logger;
use App\Services\Logger\LoggerService;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\Request;

class StatisticsController
{
    use DefaultRender;

    protected $request;
    protected $service;

    public function __construct(Request $request, LoggerService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    public function logger(Logger $logger)
    {
        return $this->getStatistics($logger, 'logger');
    }

    public function shortener(Logger $logger)
    {
        return $this->getStatistics($logger, 'shortener');
    }

    protected function getStatistics(Logger $logger, String $type)
    {
        try {
            $follows = $this->service->selectFollowStatistics(
                $logger->id,
                $this->request->get('first_date'),
                $this->request->get('second_date'),
                $this->request->get('unique')
            );
        } catch (InvalidFormatException $e) {
            return back()->with('error', 'Invalid date format given.');
        }

        $loggers = $this->renderLoggers($this->request);

        return view("$type.statistics", compact('logger', 'follows', 'loggers'));
    }
}
