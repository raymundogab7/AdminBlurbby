<?php

namespace Admin\Http\Requests;

use Admin\Http\Requests\Request;

class BlurbRequest extends Request
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
            'blurb_name' => 'required',
            'blurb_category_id' => 'required',
            'blurb_start' => 'required',
            'blurb_end' => 'required',
            'blurb_desc' => 'required',
            'blurb_terms' => 'required',
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
        if (is_null($this->blurb_id)) {
            return $this->redirector->to('blurb/create/' . $this->control_no_temp)
                ->withInput()
                ->with(['errors' => $errors]);
        }

        return $this->redirector->to('blurb/' . $this->blurb_id . '/' . $this->control_no)
            ->withInput()
            ->with(['errors' => $errors]);
    }
}
