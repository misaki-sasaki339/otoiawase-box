<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\User;

use App\Http\Requests\Auth\LoginRequest;

use Illuminate\Support\Facades\Redirect;


class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
        \Laravel\Fortify\Http\Requests\LoginRequest::class,
        \App\Http\Requests\Auth\LoginRequest::class
    );
    
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        //登録画面のビュー措定
        Fortify::registerView(function(){
            return view('auth.register');
        });

        //ログイン画面のビュー指定
        Fortify::loginView(function(){
            return view('auth.login');
        });

        //セキュリティ的に試行回数の制限を追加
        RateLimiter::for('login', function(Request $request){
        $email = (string)$request->email;
        return Limit::perMinute(5)->by($email . $request->ip());
        });
    }
}
