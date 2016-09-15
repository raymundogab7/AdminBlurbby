<?php

namespace Admin\Http\Requests;

use Admin\Http\Requests\Request;

class MerchantRequest extends Request
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
                'coy_zip' => 'required|min:6|max:6',
                'coy_phone' => 'required|min:8|max:8',
                'res_name' => 'required|unique:restaurant',
                'outlet_add' => 'required',
                'outlet_zip' => 'required|min:6|max:6',
                'outlet_phone' => 'required',
            ];
        }

        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|required', //|unique:merchant,email,' . $this->merchant_id
            'coy_phone' => 'required|min:8|max:8',
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
            'coy_zip.max' => 'Company postal code maxlength is 6',
            'coy_zip.min' => 'Company postal code minimum is 6.',
            'coy_phone.required' => 'The company phone field is required.',
            'coy_phone.min' => 'The contact number field may not be less than 8 characters.',
            'coy_phone.max' => 'The contact number field may not be more than 8 characters.',
            'outlet_add.required' => 'The outlet address field is required.',
            'outlet_zip.required' => 'The outlet postal zip field is required.',
            'outlet_zip.max' => 'Outlet postal code maxlength is 6',
            'outlet_zip.min' => 'Outlet postal code minimum is 6.',
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

        return $this->redirector->to('merchants/' . $this->merchant_id . '/edit')
            ->withInput()
            ->with(['errors' => $errors]);
    }
}
