<?php
namespace Summonshr\ReviewRatings\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model {
    use SoftDeletes;

    public $casts = [
        'user_id'=>'integer',
        'resource_id'=>'integer',
    ];

    
}