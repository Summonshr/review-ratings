<?php

use Summonshr\ReviewRatings\Controllers\ReviewController;

Route::middleware('api')->group(function(){
    Route::resource(config('reviews.route'),ReviewController::class)->only(['index','store','destroy']);
});