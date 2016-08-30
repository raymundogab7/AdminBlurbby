<?php

namespace Admin\Http\Requests;

use Admin\Http\Requests\Request;

class AppUserRequest extends Request
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
        if (is_null($this->app_user_id)) {

            return [
                'status' => 'required',
                'email' => 'required|email', //|unique:app_user',
                'first_name' => 'required',
                'last_name' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'min:6',
            ];
        }

        return [
            'status' => 'required',
            'email' => 'required|email', //|unique:app_user,email,' . $this->app_user_id,
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
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
            'password.confirmed' => 'Email entered do not match.',
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
        if (is_null($this->app_user_id)) {
            return $this->redirector->to('app-users/create')
                ->withInput()
                ->with(['errors' => $errors]);
        }

        return $this->redirector->to('app-users/' . $this->app_user_id . '/edit')
            ->withInput()
            ->with(['errors' => $errors]);
    }
}
