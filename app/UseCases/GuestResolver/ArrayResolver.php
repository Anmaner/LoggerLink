<?php

namespace App\UseCases\GuestResolver;

class ArrayResolver implements GuestResolverInterface
{
    protected $requestManager;
    protected $url;

    protected $ip;
    protected $continent;
    protected $continentCode;
    protected $country;
    protected $countryCode;
    protected $region;
    protected $city;
    protected $zip;
    protected $lat;
    protected $lon;
    protected $timezone;
    protected $provider;
    protected $isMobile;
    protected $isProxy;

    public function setInformation(array $information)
    {
        $this->setAllData($information);
    }

    public function loadInformation($ip)
    {
        //
    }

    public function getAllInformation()
    {
        return $this->country;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getProvider()
    {
        return $this->provider;
    }

    protected function setAllData(array $data)
    {
        $this->continent = $data['continent'] ?? '';
        $this->continentCode = $data['continentCode'] ?? '';
        $this->country = $data['country'] ?? '';
        $this->countryCode = $data['countryCode'] ?? '';
        $this->region = $data['regionName'] ?? '';
        $this->city = $data['city'] ?? '';
        $this->zip = $data['zip'] ?? '';
        $this->lat = $data['lat'] ?? '';
        $this->lon = $data['lon'] ?? '';
        $this->timezone = $data['timezone'] ?? '';
        $this->provider = $data['isp'] ?? '';
        $this->isMobile = $data['mobile'] ?? '';
        $this->isProxy = $data['proxy'] ?? '';
    }
}
