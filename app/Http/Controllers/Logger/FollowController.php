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
    protected $request;
    protected $resolver;

    public function __construct(FollowService $service, Request $request, GuestResolverInterface $resolver)
    {
        $this->service = $service;
        $this->request = $request;
        $this->resolver = $resolver;
    }

    public function logger(Logger $logger)
    {
        $this->follow($logger);

        header("HTTP/1.0 404 Not Found");
        exit();
    }
    public function shortener(Logger $logger)
    {
        $this->follow($logger);

        $path = $this->service->determineRedirectPath($this->resolver, $logger->id);

        if($path) {
            return redirect($path);
        } else {
            abort(404);
        }
    }

    protected function follow($logger)
    {
        try {
            $this->service->follow(
                $this->resolver,
                '93.75.53.236',
                $logger->id,
                $this->request->server('HTTP_REFERER') ?? '',
            );
        } catch (\DomainException $e) {
            abort(404);
        }
    }
}
