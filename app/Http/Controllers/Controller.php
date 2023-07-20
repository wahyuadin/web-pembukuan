<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function upload()
    {
        return view('upload');
    }
    public function prosesupload(Request $request)
    {
        $this->validate($request, [
            'file'  => "required",
            'keterangan'    => "required"
        ]);
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');

                // nama file
        echo 'File Name: '.$file->getClientOriginalName();
        echo '<br>';

                // ekstensi file
        echo 'File Extension: '.$file->getClientOriginalExtension();
        echo '<br>';

                // real path
        echo 'File Real Path: '.$file->getRealPath();
        echo '<br>';

                // ukuran file
        echo 'File Size: '.$file->getSize();
        echo '<br>';

                // tipe mime
        echo 'File Mime Type: '.$file->getMimeType();

                // isi dengan nama folder tempat kemana file diupload
        $tujuan_upload = 'data_file';

            // upload file
        $file->move($tujuan_upload,$file->getClientOriginalName());
    }
}

