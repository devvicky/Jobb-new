<?php namespace App\Jobtip\Sms;

use Illuminate\Support\ServiceProvider;

class SmsServiceProvider extends ServiceProvider{

    public function register()
    {
        $this->app->bind('sms', 'App\Jobtip\Sms\Sms');
    }

}