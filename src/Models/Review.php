<?php

namespace Summonshr\ReviewRatings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;

    public $fillable = [
        'email',
        'phone_number',
        'review',
        'rating',
    ];

    public $casts = [
        'user_id' => 'integer',
        'resource_id' => 'integer',
        'approved' => 'boolean'
    ];

    public $visible = ['id', 'review', 'rating', 'type', 'reviewer_email', 'reviewer_phone_number', 'reviewed'];

    public $appends = ['type', 'reviewer_email', 'reviewer_phone_number', 'reviewed'];

    public function reviewable()
    {
        return $this->morphTo();
    }

    public function getReviewedAttribute()
    {
        return $this->reviewable;
    }

    public function getTypeAttribute()
    {
        return array_flip(config('reviews.types'))[$this->reviewable_type];
    }

    public function getReviewerEmailAttribute()
    {
        $arr = explode('@', $this->attributes['email']);
        return substr($arr[0], 0, 3) . str_repeat('*', strlen($arr[0]) - 3) . $arr[1];
    }

    public function getReviewerPhoneNumberAttribute()
    {
        if ($this->attributes['phone_number'] ?? false) {
            return substr($this->attributes['phone_number'], 0, 3) . str_repeat('*', strlen($this->attributes['phone_number']) - 3);
        }
        return '';
    }
}
