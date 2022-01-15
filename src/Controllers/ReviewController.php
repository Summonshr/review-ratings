<?php

namespace Summonshr\ReviewRatings\Controllers;

use Summonshr\ReviewRatings\Contracts\ReviewableModel;
use Summonshr\ReviewRatings\Models\Review;
use Summonshr\ReviewRatings\Requests\DestroyReview;
use Summonshr\ReviewRatings\Requests\ListReview;
use Summonshr\ReviewRatings\Requests\StoreReview;
use Summonshr\ReviewRatings\Requests\UpdateReview;

class ReviewController
{

    public function index(ListReview $request, ReviewableModel $model)
    {
        $reviews = $model->reviews()->get();
        return [
            'average'=> $reviews->avg('rating'),
            'total'=> $reviews->count(),
            'reviews' => $reviews->each->setHidden(['reviewed']),
        ];
    }

    public function store(StoreReview $request, ReviewableModel $model)
    {
        $review = new Review;
        $review->fill($request->validated());

        $model->reviews()->save($review);

        return $review;
    }
}
