<?php

namespace Admin\Http\Requests;

use Admin\Http\Requests\Request;

class CampaignRequest extends Request
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
            'campaign_name' => 'required',
            'cam_timezone' => 'required',
            'cam_start' => 'required',
            'cam_end' => 'required',
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
        return $this->redirector->to('campaign/create')
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
            'cam_start.required' => 'The campaign start date is required.',
            'cam_end.required' => 'The campaign end date is required.',
        ];
    }
}
