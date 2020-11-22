<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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

    public function rules()
    {
        return ['email' => 'required|email', 'password' => 'required'];
    }

    public function getLoginDto()
    {
        return (object)['email' => $this->input('email'), 'password' => $this->input('password')];
    }
}
