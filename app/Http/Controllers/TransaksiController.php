<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class TransaksiController extends Controller
{
    public function index()
    {
        return view('transaksi.transaksi', ["data" => TransaksiModel::all()]);
    }

    public function tambah()
    {
        return view('transaksi.tambah', ["data" => Kategori::all()]);
    }

    public function tambahSimpan(Request $request)
    {
        $this->validate($request, [
            "nama"          => "required|min:3|max:30|",
            "pengeluaran"   => "numeric",
            "pemasukan"     => "numeric",
            "nota"          => "unique:transaksi_models,nota|required|min:3",
            "tanggal"       => "required",
            "kategori"      => "required",
            "catatan"       => "required|min:5",
        ]);

        $data               = new TransaksiModel;
        $data->id_user      = Auth::user()->id_user;
        $data->nama         = $request->nama;
        $data->pemasukan    = $request->pemasukan;
        $data->kategori     = $request->kategori;
        $data->pengeluaran  = $request->pengeluaran;
        $data->tanggal      = $request->tanggal;
        $data->nota         = $request->nota;
        $data->catatan      = $request->catatan;

        if ($data->save()) {
            Alert::success('Success', 'Data Berhasil Di Tambah!');
            return redirect('/transaksi');
        }
    }

    public function edit($id)
    {
        return view('transaksi.edit',["data" => TransaksiModel::find($id), "kategori" => Kategori::all()]);
    }

    public function simpanEdit(Request $request)
    {
        $this->validate($request, [
            "id"            => "required",
            "id_user"       => "required",
            "nama"          => "required|min:3|max:30|",
            "pengeluaran"   => "numeric",
            "pemasukan"     => "numeric",
            "nota"          => "required|min:3",
            "tanggal"       => "required",
            "kategori"      => "required",
            "catatan"       => "required|min:5",
        ]);
        if (TransaksiModel::whereId($request->id)->update($request->except('_token'))) {
            Alert::success('Success', 'Data Berhasil Di Update!');
            return redirect('/transaksi');
        }
    }

    public function hapus($id)
    {
        TransaksiModel::find($id)->delete();
        Alert::success('Success', 'Data Berhasil Di Hapus!');
        return redirect('/transaksi');
    }


    // kategori
    public function kategori()
    {

        return view('kategori.kategori',["data" => Kategori::all()]);
    }

    public function kategoriSimpan(Request $request)
    {
        $this->validate($request, [
            'id_user'   => 'required',
            'nama'      => 'unique:kategoris,nama|required|min:5',
        ]);

        $model = new Kategori;
        $model->id_user = $request->id_user;
        $model->nama    = $request->nama;
        if ($model->save()) {
            Alert::success('Success', 'Data Berhasil Di Tambah!');
            return redirect('/kategori');
        }
    }

   public function editkategori($id) {
        return view ('kategori.edit',["data" => Kategori::where('id',$id)->get()]);
   }

   public function editsimpan(Request $request) {
        $this->validate($request, [
            "id"        => 'required',
            'id_user'   => 'required',
            'nama'      => 'required|min:3|max:50|unique:kategoris,nama',
        ]);

        Kategori::where('id', $request->id)->update([
            'id_user'   => $request->id_user,
            'nama'      => $request->nama
        ]);
        Alert::success('Success', 'Data Berhasil Di Edit!');
        return redirect('/kategori');
   }

   public function hapuskategori($id) {
    Kategori::where('id', $id)->delete();
    Alert::success('Success', 'Data Berhasil Di Hapus!');
    return redirect('/kategori');
   }

}
