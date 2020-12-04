<?php

namespace App\Providers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, current($parameters));
        });
        Validator::extend('verify_otp', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, current($parameters));
        });
        Validator::extend('bd_mobile', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(01)[1-9]{1}[0-9]{8}$/', $value);
        });
    }
}
