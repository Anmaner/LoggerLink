<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

trait DefaultRender
{
    public function renderLoggers(Request $request)
    {
        if($user = $request->user()) {
            return $user->loggers()->get() ?? [];
        }

        return [];
    }
}
