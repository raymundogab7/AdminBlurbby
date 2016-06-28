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
            'coy_zip' => 'required',
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
        return $this->redirector->to('merchant-profile')
            ->withInput()
            ->with(['errors' => $errors]);
        
    }
}
