<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TambahBuku extends FormRequest
{

    public function rules()
    {
        return [
            "nama_buku"         => "required|min:3|max:50",
            "id_buku"           => "required|min:3|max:50",
            "isbn"              => "required|min:5|max:50",
            "tgl_terbit"        => "required",
            "penulis"           => "required|min:5|max:50",
            "stok"              => "required",
            "harga"             => "required",
            "gambar"            => "required",
        ];
    }
}
