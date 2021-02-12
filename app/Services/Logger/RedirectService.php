<?php

namespace App\Services\Logger;

use App\Models\Logger\Country;
use App\Models\Logger\Logger;
use App\Models\Logger\Redirect;
use App\UseCases\Logger\CountryUrl;
use Illuminate\Support\Facades\DB;

class RedirectService
{
    public function makeCountryUrlList(?array $countries, ?array $urls): array
    {
        $countryUrlList = [];

        for ($i = 0; $i < count($countries ?? []); $i++) {
            $country = Country::where('name', $countries[$i])->firstOrFail();
            $countryUrlList[] = new CountryUrl($country, $urls[$i]);
        }

        return $countryUrlList;
    }

    public function updateLoggerRedirect(array $countryUrlList, Logger $logger): void
    {
        DB::transaction(function() use ($countryUrlList, $logger) {
            $logger->redirects()->delete();

            foreach ($countryUrlList as $countryUrl) {
                $this->createRedirect($countryUrl, $logger);
            }
        });
    }

    protected function createRedirect($countryUrl, $logger): void
    {
        $redirect = Redirect::make([
            'url' => $countryUrl->getUrl()
        ]);

        $redirect->logger()->associate($logger);
        $redirect->country()->associate($countryUrl->getCountry());

        $redirect->saveOrFail();
    }
}
