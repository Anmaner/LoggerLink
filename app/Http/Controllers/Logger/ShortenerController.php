<?php

namespace App\Http\Controllers\Logger;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShortenerController extends Controller
{
    public function generate()
    {
        //
    }

    public function information($id)
    {
        return view('shortener.information', compact('id'));
    }

    public function informationStore()
    {
        //
    }

    public function statistics(Request $request, $id)
    {
        return view('shortener.statistics', compact('id'));
    }

    public function redirect($id)
    {
        return view('shortener.redirect', compact('id'));
    }

    public function redirectStore(Request $request)
    {
        dump($request->all());
        die();
    }

    public function export($id)
    {
        return view('shortener.export', compact('id'));
    }

    public function exportDownload()
    {
        //
    }
}
