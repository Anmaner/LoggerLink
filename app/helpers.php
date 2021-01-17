<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('is_current_route')) {

    function is_current_route(string $routeName): bool
    {
        return Route::currentRouteName() === $routeName;
    }
}
