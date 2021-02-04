<?php

namespace App\Services;

use App\Models\Logger\Follow;
use App\Models\Logger\Logger;
use App\UseCases\GuestResolver\GuestResolverInterface;
use Sinergi\BrowserDetector\Browser;
use Sinergi\BrowserDetector\Os;

class FollowService
{
    protected $browserDetector;
    protected $osDetector;

    public function __construct()
    {
        $this->browserDetector = new Browser();
        $this->osDetector = new Os();
    }

    public function follow(GuestResolverInterface $resolver, String $userIp, Int $loggerId, String $whereFrom): Follow
    {
        $logger = Logger::find($loggerId);
        $this->guardLoggerIsEnable($logger);

        $resolver->loadInformation($userIp);

        return $logger->follows()->create([
            'ip' => $userIp,
            'country' => $resolver->getCountry(),
            'city' => $resolver->getCity(),
            'provider' => $resolver->getProvider(),
            'os' => $this->osDetector->getName(),
            'browser' => $this->browserDetector->getName(),
            'from' => $whereFrom
        ]);
    }

    protected function guardLoggerIsEnable(Logger $logger)
    {
        if(!$logger->isEnable()) {
            throw new \DomainException('Current Logger is disable.');
        }
    }
}
