<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'category_id' => 'required|numeric',
            'product_name_en' => 'required',
            'product_name_hi' => 'required',
            'product_code' => 'nullable',
            'product_qty' => 'required|numeric',
            'product_tags_en' => 'nullable',
            'product_tags_hi' => 'nullable',
            'short_description_en' => 'nullable',
            'short_description_hi' => 'nullable',
            'long_description_en' => 'nullable',
            'long_description_hi' => 'nullable',
            'product_thumbnail' => 'required|mimes:png,jpg',
            'product_images' => 'nullable',
            'status' => 'nullable',
        ];
    }
}
