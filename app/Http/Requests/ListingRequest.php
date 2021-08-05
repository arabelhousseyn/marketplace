<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
           'title' => 'required|max:255|string',
           'price' => 'required|numeric',
           'description' => 'required|string',
           'location' => 'required|string',
           "category_id" => 'required',
           "attributes" => "string",
        'images.*' => 'mimes:jpeg,jpg,png,gif|max:2048'
        ];
    }
}
