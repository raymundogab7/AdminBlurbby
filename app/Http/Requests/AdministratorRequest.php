<?php

namespace Admin\Http\Requests;

use Admin\Http\Requests\Request;

class AdministratorRequest extends Request
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
        if (is_null($this->admin_id)) {

            return [
                'role_id' => 'required',
                'email' => 'required|email|unique:admin',
                'first_name' => 'required',
                'last_name' => 'required',
                'title' => 'required',
                //  'profile_photo' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'min:6',
            ];
        }

        return [
            //'role_id' => 'required',
            'email' => 'required|email|unique:admin,email,' . $this->admin_id,
            'first_name' => 'required',
            'last_name' => 'required',
            'title' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'password' => 'confirmed',
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
            'role_id.required' => 'The type field is required.',
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
        if (is_null($this->admin_id)) {
            return $this->redirector->to('administrators/create')
                ->withInput()
                ->with(['errors' => $errors]);
        }

        return $this->redirector->to('/administrators/' . $this->admin_id . '/edit')
            ->withInput()
            ->with(['errors' => $errors]);
    }
}
