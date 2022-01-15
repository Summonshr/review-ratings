<?php

namespace Summonshr\ReviewRatings\Traits;

use Summonshr\ReviewRatings\Models\Review;

trait HasReviews
{
    public function reviews()
    {
        return $this->morphOne(Review::class, 'reviewable');
    }
}
