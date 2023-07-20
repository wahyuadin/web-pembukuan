<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class register extends FormRequest
{

    public function rules()
    {
        return [
            "nama_depan"        => "required|min:3|max:50",
            "nama_belakang"     => "required|min:3|max:50",
            "email"             => "required|min:5|email|max:50",
            "password1"         => "required|min:5|max:50",
            "password2"         => "required|min:5|max:50",
            "id_user"           => "required"
        ];
    }
}
