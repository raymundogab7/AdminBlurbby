<?php

namespace Admin\Http\Requests;

use Admin\Http\Requests\Request;

class OutletRequest extends Request
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
            'outlet_add' => 'required',
            'outlet_country' => 'required',
            'outlet_zip' => 'required|min:6|max:6',
            'outlet_phone' => 'required',
            'outlet_timezone' => 'required',
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
            'outlet_add.required' => 'The outlet address field is required.',
            'outlet_country.required' => 'The country field is required.',
            'outlet_zip.required' => 'The outlet postal code field is required.',
            'outlet_zip.max' => 'Outlet postal code maxlength is 6',
            'outlet_zip.min' => 'Outlet postal code minimum is 6.',
            'outlet_phone.required' => 'The outlet phone number field is required.',
            'outlet_timezone.required' => 'The timezone field is required.',
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
        if (!is_null($this->from_main)) {
            return $this->redirector->to('merchants/'.$this->merchant_id.'/edit')
                ->withInput()
                ->with(['errors' => $errors]);
        }

        if (is_null($this->outlet_id)) {
            return $this->redirector->to('outlets/'.$this->merchant_id.'/create')
                ->withInput()
                ->with(['errors' => $errors]);
        }

        return $this->redirector->to('outlets/' . $this->outlet_id . '/edit')
            ->withInput()
            ->with(['errors' => $errors]);

    }
}
