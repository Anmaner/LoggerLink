<?php

namespace App\Services;

use App\Models\Logger\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoggerService
{
    public function generate(): string
    {
        $logger = Logger::generateLogger(
            $user = Auth::user(),
            $token = $this->getUniqueToken()
        );

        // event

        return $token;
    }

    public function selectStatistics(Logger $logger, ?String $first_date, ?String $second_date, ?String $unique)
    {
        $query = $logger->follows();

        if($first_date) {
            $query = $query->dateFrom(Carbon::createFromFormat('d-m-Y', $first_date));
        } else {
            $query = $query->dateFrom((new Carbon())->subMonth());
        }

        if($second_date) {
            $query = $query->dateTo(
                Carbon::createFromFormat('d-m-Y', $second_date)
            );
        }

        if($unique) {
            return $query->get()->unique('ip');
        }

        return $query->get();
    }

    protected function getUniqueToken(): string
    {
        while(true) {
            $token = Str::random(15);

            if(Logger::notExists($token)) {
                return $token;
            }
        }
    }
}
