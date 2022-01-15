<?php

namespace Summonshr\ReviewRatings\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReview extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (bool) request(config('reviews.route-key'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => 'required|in:' . implode(',', array_keys(config('reviews.types'))),
            'email' => 'required_without:phone_number',
            'phone_number' => 'required_without:email',
            'review' => 'required',
            'name' => 'required',
            'rating' => [
                'required',
                'int',
                'min:' . config('reviews.rules.rating.min'),
                'max:' . config('reviews.rules.rating.max')
            ]
        ];
    }
}
