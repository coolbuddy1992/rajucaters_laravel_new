<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GalleyUpdateRequest extends FormRequest
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
            'photo_name' => 'required',
            'photo_location' => 'required',
            'gallery_status' => 'required',
        ];
    }
}
