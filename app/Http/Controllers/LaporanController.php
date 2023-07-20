<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use PDF;

class LaporanController extends Controller
{
    public function laporan(Request $request)
    {

        if ($request->has('filter')) {
            $this->validate($request, [
                "mulai"     => 'required',
                "akhir"     => 'required',
            ]);

            $sumpemasukan   = TransaksiModel::whereBetween('tanggal',[[$request->mulai, $request->akhir]])->sum('pemasukan');
            $sumpengeluaran = TransaksiModel::whereBetween('tanggal',[[$request->mulai, $request->akhir]])->sum('pengeluaran');
            $between        = TransaksiModel::whereBetween('tanggal',[$request->mulai, $request->akhir])->get();
            $param          = [
                                "data"          => $between, "kategori" => Kategori::all(),
                                "mulai"         => $request->mulai, "akhir"=>$request->akhir,
                                "totalmasuk"    => number_format($sumpemasukan,0,'.',''),
                                "totalkeluar"   => number_format($sumpengeluaran,0,'.','')
                                ];
            $request->session()->put('laporan', $param);
            return view('laporan.laporan',$param);

        }
        if ($request->has('pdf')) {
            // $pdf = PDF::loadview('laporan/pdf',['pdf'=> $request->session()->get('laporan')]);
            $pdf = PDF::loadview('laporan/pdf',['pdf'=> $request->session()->get('laporan')])->setPaper('a4')->save('myfile.pdf');
            return $pdf->stream();
        }
            $pemasukan          = TransaksiModel::select('transaksi_models')->sum('pemasukan');
            $pengeluaran        = TransaksiModel::select('transaksi_models')->sum('pengeluaran');
            $param              = [
                                    "data"          => TransaksiModel::all(),"kategori" => Kategori::all(),
                                    "mulai"         => "ALL", "akhir" => "ALL",
                                    "totalmasuk"    => number_format($pemasukan,0,'.',''),
                                    "totalkeluar"   => number_format($pengeluaran,0,'.',''),
                                ];
            $request->session()->put('laporan', $param);
            return view('laporan.laporan', $param);
    }


}
