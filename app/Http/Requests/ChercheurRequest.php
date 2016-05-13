<?php

namespace App\Http\Requests;

class ChercheurRequest extends Request
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
            'first_name' => 'required|min:2|max:30|alpha',
            'name' => 'required|min:2|max:30|alpha',
            'organisation' => 'required|max:50',
            'équipe' => 'required|max:50',
            'login' => 'required|email',
            'password' => 'required|min:5|max:20'
        ];
    }
}