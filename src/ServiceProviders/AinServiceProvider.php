<?php


namespace IanRothmann\Ain\ServiceProviders;
use Ianrothmann\Ain\Handlers\AinHandlerConfig;
use Illuminate\Support\ServiceProvider;

class AinServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Ain', function()
        {
            $config=new AinHandlerConfig(config('ain.url'),config('ain.key'),config('ain.cache.type'),config('ain.cache.local_ttl'),config('ain.mock.type'));
            return new AinServiceProviderHandler($config);
        });
    }
}
