<?php

namespace Admin\Http\Requests;

use Admin\Http\Requests\Request;

class AdminRequest extends Request
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
        if (is_null($this->merchant_id)) {
            return [
                'email' => 'required|email|unique:merchant',
                'email_confirmation' => 'required|email|same:email',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'required',
                'first_name' => 'required',
                'last_name' => 'required',
                'coy_name' => 'required|unique:merchant',
                'coy_add' => 'required',
                'coy_zip' => 'required',
                'coy_phone' => 'required',
                'res_name' => 'required|unique:restaurant',
                'outlet_add' => 'required',
                'outlet_zip' => 'required',
                'outlet_phone' => 'required',
            ];
        }

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|unique:merchant,email,' . $this->merchant_id,
            'coy_phone' => 'required',
            'password' => 'min:6|confirmed',
            'password_confirmation' => 'min:6',
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
            'coy_name.required' => 'The company name field is required.',
            'coy_name.unique' => 'The company name has been already taken.',
            'coy_add.required' => 'The company address field is required.',
            'coy_zip.required' => 'The company postal code field is required.',
            'coy_phone.required' => 'The company phone field is required.',
            'outlet_add.required' => 'The outlet address field is required.',
            'outlet_zip.required' => 'The outlet postal zip field is required.',
            'outlet_phone.required' => 'The outlet phone number field is required.',
            'res_name.required' => 'The restaurant name field is required.',
            'res_name.unique' => 'The restaurant name has been already taken.',
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
        if (is_null($this->merchant_id)) {
            return $this->redirector->to('register')
                ->withInput()
                ->with(['errors' => $errors]);
        }

        return $this->redirector->to('merchant-profile')
            ->withInput()
            ->with(['errors' => $errors]);
    }
}
