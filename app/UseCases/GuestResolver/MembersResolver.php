<?php

namespace App\UseCases\GuestResolver;

use App\UseCases\RequestManager\RequestManagerInterface;

class MembersResolver implements GuestResolverInterface
{
    protected $requestManager;
    protected $url;

    protected $ip;
    protected $continent;
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

    public function __construct(RequestManagerInterface $requestManager, $url = 'http://ip-api.com/json/')
    {
        $this->requestManager = $requestManager;
        $this->url = $url;
    }

    public function loadInformation($ip): self
    {
        $this->ip = $ip;

        $this->setAllData(
            $this->loadDataByIp($ip)
        );

        return $this;
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCountryCode()
    {
        return $this->countryCode;
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

    public function getAllInformation()
    {
        return [
            'ip' => $this->ip,
            'country' => $this->country,
            'countryCode' => $this->countryCode,
            'region' => $this->region ?? '',
            'city' => $this->city ?? '',
            'provider' => $this->provider ?? ''
        ];
    }

    protected function loadDataByIp($ip): array
    {
        return json_decode(
            $this->requestManager->load($this->url . $ip),
            true
        );
    }

    protected function setAllData(array $data)
    {
        $this->country = $data['country'] ?? '';
        $this->countryCode = $data['countryCode'] ?? '';
        $this->region = $data['regionName'] ?? '';
        $this->city = $data['city'] ?? '';
        $this->provider = $data['isp'] ?? '';
    }
}
