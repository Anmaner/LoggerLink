<?php

namespace App\Http\Controllers\Logger;

use App\Http\Controllers\DefaultRender;
use App\Http\Requests\Logger\LoggerRequest;
use App\Models\Logger\Logger;
use Illuminate\Http\Request;

class InformationController
{
    use DefaultRender;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function logger(Logger $logger)
    {
        return $this->getForm($logger, 'logger');
    }

    public function shortener(Logger $logger)
    {
        return $this->getForm($logger, 'shortener');
    }

    public function loggerStore(Logger $logger, LoggerRequest $request)
    {
        return $this->updateInformation($logger, $request, 'logger');
    }

    public function shortenerStore(Logger $logger, LoggerRequest $request)
    {
        return $this->updateInformation($logger, $request, 'shortener');
    }


    protected function getForm(Logger $logger, String $type)
    {
        $loggers = $this->renderLoggers($this->request);

        return view("$type.information", compact('loggers', 'logger'));
    }

    protected function updateInformation(Logger $logger, Request $request, String $type)
    {
        $logger->code = $request->get('code');
        $logger->status = $request->get('status');

        if($type === 'shortener') {
            $logger->redirect = $request->get('redirect');
        }

        $logger->saveOrFail();

        return back()->with('success', 'Information is successfully updated.');
    }

}
