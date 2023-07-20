<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Login extends FormRequest
{
    public function rules()
    {
        return [
            "email"     => "required|min:5|email|max:50|exists:users,email",
            "password"  => "required|min:5|max:50"
        ];
    }
}
