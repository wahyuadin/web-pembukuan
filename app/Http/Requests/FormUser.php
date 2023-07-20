<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormUser extends FormRequest
{
    public function rules()
    {
        return [
            "name"     => "required|min:2|max:50",
            "id_user"  => "required|min:2|max:50",
            "email"  => "required|min:2|email|max:50",
            "role"  => "required",
            "password"  => "required",
        ];
    }
}
