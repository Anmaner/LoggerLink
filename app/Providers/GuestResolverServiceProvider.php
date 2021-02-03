<?php

namespace App\Providers;

use App\UseCases\GuestResolver\ArrayResolver;
use App\UseCases\GuestResolver\GuestResolverInterface;
use App\UseCases\GuestResolver\MembersResolver;
use App\UseCases\RequestManager\RequestManagerInterface;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class GuestResolverServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(GuestResolverInterface::class, function(Application $app) {
            $config = $app->make('config')->get('GuestResolver');

            switch ($config['default']) {
                case 'members.ip':
                    $params = $config['resolvers']['members.ip'];

                    if(!empty($params['url'])) {
                        return new MembersResolver($app->make(RequestManagerInterface::class), $params['url']);
                    }
                    return new MembersResolver($app->make(RequestManagerInterface::class));

                case 'array':
                    return new ArrayResolver();

                default:
                    throw new \InvalidArgumentException('Undefined GuestResolver driver ' . $config['default']);
            }
        });
    }

    public function boot()
    {
        //
    }
}
