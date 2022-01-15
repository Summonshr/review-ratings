<?php
namespace Summonshr\ReviewRatings\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Summonshr\ReviewRatings\Contracts\ReviewableModel;

class ReviewServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        $this->app->bind(ReviewableModel::class, function ($app) {
            return $app->make(config('reviews.types')[request('type')]);
        });
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes.php');

        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');

        $this->publishes([
            __DIR__.'/../config/reviews.php' => config_path('reviews.php'),
        ]);
       
        Route::bind(config('reviews.route-key'), function ($value) {
            return app(ReviewableModel::class)->where(['id'=>$value])->first();
        });
    }
}
