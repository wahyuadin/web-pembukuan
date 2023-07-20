<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Pembayaran;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Apilist extends Controller
{
    public function buku($id=null)
    {
        return $id?Buku::find($id):Buku::all();
    }

    public function datauser($id=null)
    {
        return $id?DB::table('users')->where('id', $id)->get():DB::table('users')->get();
        // return $id?User::find($id):User::all();
    }

    public function order($id=null)
    {
        return $id?Pembayaran::find($id):Pembayaran::all();
    }
}
