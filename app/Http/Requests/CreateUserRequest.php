<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class CreateUserRequest extends FormRequest
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
        return ['email' => 'required|email', 'name' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'];
    }

    public function getUserDTO()
    {
        return ['name' => $this->input('name'), 'email' => $this->input('email'),
            'password' => Hash::make($this->input('password'))];
    }
}
