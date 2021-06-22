<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username' => 'required|unique:users|min:3',
            'email' => 'required|unique:users|regex:/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,6})+$/',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required'
        ];
    }
}
