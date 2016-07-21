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
                'email' => 'required|email|unique:app_user',
                'first_name' => 'required',
                'last_name' => 'required',
                'date_of_birth' => 'required',
                'gender' => 'required',
                'password' => 'required|min:6|confirmed',
                'password_confirmation' => 'min:6',
            ];
        }

        return [
            'role_id' => 'required',
            'email' => 'required|email|unique:app_user,email,' . $this->app_user_id,
            'first_name' => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'password' => 'confirmed',
        ];
    }
}
