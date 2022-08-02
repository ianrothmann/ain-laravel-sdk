<?php


namespace IanRothmann\Ain\ServiceProviders;
use Illuminate\Support\ServiceProvider;

class AinServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('Ain', function()
        {
            return new AinServiceProviderHandler(config('ain.url'),config('ain.key'));
        });
    }
}
