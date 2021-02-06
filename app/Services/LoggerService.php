<?php

namespace App\Services;

use App\Models\Logger\Logger;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoggerService
{
    public function generateLogger(): string
    {
        Logger::generateLogger(
            $user = Auth::user(),
            $token = $this->getUniqueToken()
        );

        return $token;
    }

    public function selectFollowStatistics(Int $loggerId, ?String $first_date, ?String $second_date, ?String $unique)
    {
        $logger = Logger::findOrFail($loggerId);
        $query = $logger->follows();

        $query = $this->followDateQueryFilter($query, $first_date, $second_date);

        return $this->followUniqueQueryFilter($query, $unique);
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

    protected function followDateQueryFilter($query, $first_date, $second_date)
    {
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

        return $query;
    }

    protected function followUniqueQueryFilter($query, $unique)
    {
        if($unique) {
            return $query->get()->unique('ip');
        }

        return $query->get();
    }
}
