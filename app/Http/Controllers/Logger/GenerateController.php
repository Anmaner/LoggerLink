<?php

namespace App\Http\Controllers\Logger;

use App\Services\LoggerService;

class GenerateController
{
    protected $service;

    public function __construct(LoggerService $service)
    {
        $this->service = $service;
    }

    public function logger()
    {
        $token = $this->service->generateLogger();

        return redirect()->route('logger.information', $token);
    }

    public function shortener()
    {
        $token = $this->service->generateShortener();

        return redirect()->route('shortener.information', $token);
    }
}
