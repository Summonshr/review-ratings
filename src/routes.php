<?php

use Summonshr\ReviewRatings\Controllers\ReviewController;

Route::resource('resource/{ratingModel}/ratings',ReviewController::class)->only(['index','store','update','destroy']);
