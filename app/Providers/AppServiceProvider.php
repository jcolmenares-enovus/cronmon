<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Schema;
use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('emails', function ($attribute, $value, $parameters, $validator) {
            $value = preg_replace("/\s+/", "", $value);
            $mails = explode(',', $value);
            $rules = ['email' => 'email'];
            foreach ($mails as $mail) {
                $data = ['email' => $mail];
                $validator = Validator::make($data, $rules);
                if ($validator->fails()) {
                    return false;
                }
            }
            return true;
        });
        // fix for laravel 5.4 using multibyte strings which breaks on older mysql/mariadb
        Schema::defaultStringLength(191);

      
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }

        
    }
}
