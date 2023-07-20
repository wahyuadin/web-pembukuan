<?php

namespace App\Http\Controllers;

use App\Http\Requests\Pembayaran as RequestsPembayaran;
use App\Models\Pembayaran as ModelsPembayaran;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class Pembayaran extends Controller
{
    public function index()
    {
        return view('pembayaran.pembayaran', ["data" => ModelsPembayaran::all()]);
    }

    public function tambah()
    {
        return view('pembayaran.tambah',["id_user" => Auth::user()->id_user]);
    }

    public function simpanTambah(RequestsPembayaran $request)
    {
        $model = new ModelsPembayaran;
        $model->id_user     = $request->id_user;
        $model->kurir       = $request->kurir;
        $model->alamat      = $request->alamat;
        $model->metode      = $request->metode;
        $model->resi        = $request->resi;
        $model->status      = $request->status;
        if ($model->save()) {
            Alert::success('Success', 'Data Berhasil Di Tambah!');
                return redirect('/pembayaran');
        }

    }

    public function edit($id)
    {
        return view('pembayaran.edit', ["data" => ModelsPembayaran::find($id), "id_user" =>Auth::user()->id_user, "id" => $id]);
    }

    public function simpanEdit(RequestsPembayaran $request)
    {
        $data = array(
            "id_user"   => $request->id_user,
            "kurir"     => $request->kurir,
            "alamat"    => $request->alamat,
            "metode"    => $request->metode,
            "resi"      => $request->resi,
            "status"    => $request->status
        );
        $model = ModelsPembayaran::where('id', $request->id)
                ->update($data);
        if ($model) {
            Alert::success('Success', 'Data Berhasil Di Update!');
            return redirect('/pembayaran');
        }
    }

    public function hapus($id)
    {
        if (ModelsPembayaran::where('id', $id)->delete()) {
            Alert::success('Success', 'Data Berhasil Di Hapus!');
            return redirect('/pembayaran');
        }
    }
}
