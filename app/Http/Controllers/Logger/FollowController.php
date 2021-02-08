<?php

namespace App\Http\Controllers\Logger;

use App\Models\Logger\Logger;
use App\Services\FollowService;
use App\UseCases\GuestResolver\GuestResolverInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FollowController
{
    protected $service;

    public function __construct(FollowService $service)
    {
        $this->service = $service;
    }

    public function logger(Logger $logger, GuestResolverInterface $resolver, Request $request)
    {
        $this->follow($logger, $resolver, $request);

        header("HTTP/1.0 404 Not Found");
        exit();
    }
    public function shortener(Logger $logger, GuestResolverInterface $resolver, Request $request)
    {
        $this->follow($logger, $resolver, $request);

        if($logger->redirect) {
            return redirect($logger->redirect);
        } else {
            abort(404);
        }
    }

    protected function follow($logger, $resolver, $request)
    {
        try {
            $this->service->follow(
                $resolver,
                '93.75.53.236',
                $logger->id,
                $request->server('HTTP_REFERER') ?? '',
            );
        } catch (\DomainException $e) {
            abort(404);
        }
    }
}
