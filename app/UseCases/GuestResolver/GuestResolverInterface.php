<?php

namespace App\UseCases\GuestResolver;

interface GuestResolverInterface
{
    public function loadInformation($ip);

    public function getAllInformation();

    public function getIp();

    public function getCountry();

    public function getCountryCode();

    public function getRegion();

    public function getCity();

    public function getProvider();
}
