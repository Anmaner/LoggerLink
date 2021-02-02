<?php

namespace App\Providers;

use App\UseCases\RequestManager\ArrayRequestManager;
use App\UseCases\RequestManager\GuzzleRequestManager;
use App\UseCases\RequestManager\RequestManagerInterface;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class RequestManagerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(RequestManagerInterface::class, function(Application $app) {
            $config = $app->make('config')->get('RequestManager');

            switch ($config['default']){
                case 'guzzle':
                    return new GuzzleRequestManager(
                        new Client()
                    );

                case 'array':
                    return new ArrayRequestManager();

                default:
                    throw new \InvalidArgumentException('Undefined RequestManager driver ' . $config['default']);
            }
        });

        return null;
    }

    public function boot()
    {
        //
    }
}
