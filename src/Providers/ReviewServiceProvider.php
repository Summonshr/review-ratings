<?php
namespace Summonshr\ReviewRatings\Providers;

use Illuminate\Support\ServiceProvider;

class ReviewServiceProvider extends ServiceProvider
{
    
    protected $namespace = 'Summonshr\\';
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
    }
}
