<?php

namespace Admin\Http\Requests;

use Admin\Http\Requests\Request;

class FeaturedSectionRequest extends Request
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
            'position' => 'required',
            'merchant_id' => 'required',
            'slide_image' => 'required',
            'status' => 'required',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'merchant_id.required' => 'The merchant name is required.',
        ];
    }
}
