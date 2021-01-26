<?php

namespace App\Http\Controllers\Logger;

use App\Http\Controllers\Controller;
use App\Http\Requests\Logger\LoggerRequest;
use App\Services\LoggerService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Logger\Logger;

class LoggerController extends Controller
{
    protected $service;

    public function __construct(LoggerService $service)
    {
        $this->service = $service;
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

    public function statistics(Request $request, $id)
    {
        return view('logger.statistics', compact('id'));
    }

    public function export($id)
    {
        return view('logger.export', compact('id'));
    }

    public function exportDownload()
    {
        //
    }
}
