<?php

namespace App\UseCases\Logger;

use App\Models\Logger\Country;

class CountryUrl
{
    protected $country;
    protected $url;

    public function __construct(Country $country, $url)
    {
        $this->country = $country;
        $this->url = $url;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
