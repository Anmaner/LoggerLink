<?php

namespace App\Http\Controllers\Logger;

use App\Http\Controllers\DefaultRender;
use App\Http\Requests\Logger\RedirectRequest;
use App\Models\Logger\Logger;
use App\Services\RedirectService;
use Illuminate\Http\Request;

class RedirectController
{
    use DefaultRender;

    protected $request;
    protected $service;

    public function __construct(RedirectService $service)
    {
        $this->service = $service;
    }

    public function shortener(Logger $logger, RedirectRequest $request)
    {
        $redirects = $logger->redirects()->get();

        $loggers = $this->renderLoggers($request);

        return view('shortener.redirect', compact('loggers', 'logger', 'redirects'));
    }

    public function shortenerStore(Logger $logger, RedirectRequest $request)
    {
        try {
            $countryUrlList = $this->service->makeCountryUrlList(
                $request->get('country'),
                $request->get('url')
            );

            $this->service->updateLoggerRedirect($countryUrlList, $logger);

        } catch (\DomainException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Country redirects are successfully updated.');
    }
}
