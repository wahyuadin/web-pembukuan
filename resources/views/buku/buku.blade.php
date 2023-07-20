@extends('layout.app')

@section('judul', 'Halaman Buku')
@section('buku','active')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">@yield('judul')</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="icon text-blue-50">
                <a href="/buku/tambah" class="btn btn-primary rounded"><i class="fas fa-plus"></i> Tambah Buku</a>
            </span>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Buku</th>
                            <th>ID Buku</th>
                            <th>ISBN</th>
                            <th>Tanggal Terbit</th>
                            <th>Penulis</th>
                            <th>Stok Buku</th>
                            <th>Gambar</th>
                            <th>Harga Buku</th>
                            <th>Action</th>
                        </tr>
                        <?php $no = 1;?>
                    </thead>
                    @foreach ($data as $d)
                    <tbody>
                        <td>{{$no++}}</td>
                            <td>{{$d->nama_buku}}</td>
                            <td>{{$d->id_buku}}</td>
                            <td>{{$d->isbn}}</td>
                            <td>{{$d->tgl_terbit}}</td>
                            <td>{{$d->penulis}}</td>
                            <td>{{$d->stok}}</td>
                            <td><img src="/data_file/{{$d->gambar}}" alt="{{$d->gambar}}"  width="100"></td>
                            <td>Rp. {{$d->harga}}</td>
                            <td>
                                <a href="/buku/edit/{{$d->id_buku}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="/buku/hapus/{{$d->id_buku}}" onclick="alert()" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                            </td>
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
