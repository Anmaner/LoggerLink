<?php

namespace App\Services;

use App\Models\Logger\Logger;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoggerService
{
    public function generate(): string
    {
        $logger = Logger::generate(
            $user = Auth::user(),
            $token = $this->getUniqueToken()
        );

        // event

        return $token;
    }

    protected function getUniqueToken()
    {
        while(true) {
            $token = Str::random(15);

            if(Logger::notExists($token)) {
                return $token;
            }
        }
    }
}
