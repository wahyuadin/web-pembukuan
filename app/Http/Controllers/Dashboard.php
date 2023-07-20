<?php

namespace App\Http\Controllers;

use App\Http\Requests\TambahBuku;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\TransaksiModel;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class Dashboard extends Controller
{
    public function simpanBuku(TambahBuku $request)
    {
        $this->validate($request, [
            'gambar'  => "required"
        ]);
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('gambar');
        if (in_array($file->getClientOriginalExtension(),['jpg','png','jpeg'])) {
            $file->move('data_file',$file->getClientOriginalName());
        } else {
            Alert::error('Gagal', 'File Tidak Sesuai Extensi!');
            return redirect('/buku/tambah');
        }
        $model = new Buku();
        $model->id_buku     = $request->input('id_buku');
        $model->isbn        = $request->input('isbn');
        $model->nama_buku   = $request->input('nama_buku');
        $model->tgl_terbit  = $request->input('tgl_terbit');
        $model->penulis     = $request->input('penulis');
        $model->stok        = $request->input('stok');
        $model->harga       = $request->input('harga');
        $model->gambar      = $file->getClientOriginalName();

        if ($model->save()) {
            Alert::success('Success', 'Data Berhasil Di Simpan!');
            return redirect('/buku');
        }
    }

    public function buku()
    {
        $data = DB::table('bukus')->get();

        return view('buku.buku', ['data' => $data]);
    }

    public function tambahbuku()
    {
        $id = DB::table('bukus')->select(DB::raw('RIGHT (bukus.id_buku,3) AS kode','FALSE'))
                                ->orderBy('id_buku','DESC')
                                ->limit(1)->get();
        if ($id->count()<>0) {
            $kode = intval($id[0]->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode,3,"0",STR_PAD_LEFT);
        $kodejadi = "BK-".$kodemax;

        return view('buku.tambah' ,['kodeid' => $kodejadi]);
    }

    public function editBuku($id_buku)
    {
        $data = DB::table('bukus')->where('id_buku', $id_buku)->get();
        return view('buku.editbuku', ['data' => $data]);
    }

    public function editSimpan(TambahBuku $request)
    {

        $update = DB::table('bukus')
            ->where('id_buku', $request->input('id_buku'))
            ->update([
                'id_buku'           => $request->input('id_buku'),
                'isbn'              => $request->input('isbn'),
                'nama_buku'         => $request->input('nama_buku'),
                'tgl_terbit'        => $request->input('tgl_terbit'),
                'penulis'           => $request->input('penulis'),
                'stok'              => $request->input('stok'),
                'harga'             => $request->input('harga'),
                'gambar'            => 'default.jpg'
        ]);
        if ($update) {
            Alert::success('Success', 'Data Berhasil Di Update!');
            return redirect('/buku');
        }
    }

    public function hapusBuku($id_buku)
    {
        if (DB::table('bukus')->where('id_buku', $id_buku)->delete()) {
            Alert::success('Success', 'Data Berhasil Di Hapus!');
            return redirect('/buku');
        }

    }

    public function dashboard()
    {
       return view('welcome',['data' => TransaksiModel::all()]);
    }
}
