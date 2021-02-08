<?php

namespace App\Services;

use App\Models\Logger\Logger;
use App\UseCases\FileGenerator\FileGeneratorFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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

    public function generateShortener(): string
    {
        Logger::generateShortener(
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

    public function generateExportStatistics(Collection $follows, String $fileType, array $fields)
    {
        if($follows->isEmpty()) {
            throw new \DomainException('There are no records for the specified filters.');
        }

        $followsStatistics = $this->addDateTimeFieldsToFollows($follows);

        $fileGenerator = FileGeneratorFactory::create($fileType);

        return $fileGenerator->generate($followsStatistics, $fields);
    }

    public function loadStatisticsToFile(String $loggerId, String $type, $statistics): string
    {
        $fileDir = "public/files/export-{$loggerId}.{$type}";

        Storage::put($fileDir, $statistics);

        return $fileDir;
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

    protected function addDateTimeFieldsToFollows($follows)
    {
        $arrayFollows = $follows->toArray();

        foreach ($arrayFollows as $key=>$follow) {
            $arrayFollows[$key]['date'] = $follows->offsetGet($key)->created_at->format('Y-m-d');
            $arrayFollows[$key]['time'] = $follows->offsetGet($key)->created_at->format('H:i:s');
        }

        return $arrayFollows;
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
