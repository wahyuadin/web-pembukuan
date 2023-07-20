@extends('layout.app')

@section('judul', 'Halaman Transaksi')
@section('transaksi','active')

@section('content')
<?php
    function id($id)
    {
        $data =  DB::table('users')->where('id_user', $id)->get();
        foreach ($data as $d) {
            return $d->name;
        }
    }

    function rp($angka)
    {
        $hasil = "Rp " . number_format($angka,2,',','.');
        return $hasil;
    }

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">@yield('judul')</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="icon text-blue-50">
                <a href="/transaksi/tambah" class="btn btn-primary rounded"><i class="fas fa-plus"></i> Tambah Data</a>
            </span>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>No Nota</th>
                            <th>Pelapor</th>
                            <th>Nama Transaksi</th>
                            <th>Kategori</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                            <th>Catatan</th>
                            <th>Action</th>
                        </tr>
                        <?php $no = 1;?>
                    </thead>
                    @foreach ($data as $d)
                    <tbody>
                            <td>{{$no++}}</td>
                            <td>{{$d->tanggal}}</td>
                            <td>{{$d->nota}}</td>
                            <td>{{id($d->id_user)}}</td>
                            <td>{{$d->nama}}</td>
                            <td>{{$d->kategori}}</td>
                            <td>{{rp($d->pemasukan)}}</td>
                            <td>{{rp($d->pengeluaran)}}</td>
                            <td><textarea class="form-control" style="width: auto" readonly>{{$d->catatan}} </textarea></td>
                            @if (Auth::user()->role == "admin")
                            <td>
                                <a href="/transaksi/edit/{{$d->id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="/transaksi/hapus/{{$d->id}}" onclick="alert()" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                            @endif
                            @if ($d->id_user == Auth::user()->id_user)
                                @if (Auth::user()->role == "user")
                                    <td>
                                        <a href="/transaksi/edit/{{$d->id}}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    </td>
                                @endif
                            @else
                            @endif
                        </tbody>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function alert() {
      confirm("Yakin Hapus Data ?");
    }
    </script>

<!-- End of Main Content -->
@endsection
