<?php

namespace Admin\Http\Requests;

use Admin\Http\Requests\Request;

class CompanyRequest extends Request
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
            'coy_name' => 'required',
            'coy_add' => 'required',
            'coy_country' => 'required', 
            'coy_zip' => 'required|min:6|max:6',
            'coy_phone' => 'required',
            'coy_url' => 'required',
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
        return $this->redirector->to('merchants/'.$this->merchant_id.'/edit')
            ->withInput()
            ->with(['errors' => $errors]);
        
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'coy_name.required' => 'The Company name is required.',
            'coy_add.required' => 'The Registered address is required.',
            'coy_country.required' => 'The Country is required.',
            'coy_zip.required' => 'The Postal code is required.',
            'coy_zip.max' => 'Postal code maxlength is 6',
            'coy_zip.min' => 'Postal code minimum is 6.',
            'coy_phone.required' => 'The Company Phone Number is required.',
            'coy_url.required' => 'The Company Website URL is required.',

        ];
    }
}
