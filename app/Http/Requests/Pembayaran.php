<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Pembayaran extends FormRequest
{
    public function rules()
    {
        return [
            "id"           => "",
            "id_user"     => "required",
            "kurir"     => "required",
            "alamat"    =>  "required",
            "metode"    =>  "required",
            "resi"      =>  "required",
            "status"      =>  "required",
        ];
    }
}
