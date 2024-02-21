<?php

namespace App\Providers;

use Dotenv\Validator;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        FacadesValidator::extend('no_bad_words', 'App\Validators\BadWords@validate');
        FacadesValidator::replacer('no_bad_words', 'App\Validators\BadWords@message');
    }
}
