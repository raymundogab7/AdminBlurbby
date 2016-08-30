<?php

namespace Admin\Http\Requests;

use Admin\Http\Requests\Request;

class RestaurantRequest extends Request
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
            'res_name' => 'required',
            //'res_url' => 'unique:restaurant,res_url,' . $this->res_id,
            'res_cuisine' => 'required',
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
            'res_name.required' => 'The eatery name field is required.',
            //'res_url.required' => 'The restaurant website url field is required.',
            'res_cuisine.required' => 'The eatery cuisine is required.',
        ];
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {

        return $this->redirector->to('merchants/' . $this->merchant_id . '/edit')
            ->withInput()
            ->with(['errors' => $errors]);

    }
}
