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
        if($resource = request(config('reviews.route-key'))) {
            if($resource->reviews()
            ->when($this->get('email'), fn ($query) => $query->where('email', $this->get('email')))
            ->when($this->get('phone_number'), fn ($query) => $query->where('phone_number', $this->get('phone_number')))
            ->when($this->get('review'), fn ($query) => $query->where('review', $this->get('review')))
            ->count() > 0){
                abort(409,'Review already exists');
                return;
            }
        }
        return true;
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
