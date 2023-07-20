@extends('layout.app')

@section('judul', 'Halaman Order')
@section('order','active')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">@yield('judul')</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="icon text-blue-50">
                <a href="/pembayaran/tambah" class="btn btn-primary rounded"><i class="fas fa-plus"></i> Tambah Data</a>
            </span>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Alamat</th>
                            <th>Metode</th>
                            <th>Kurir</th>
                            <th>Resi</th>
                            <th>Status</th>
                            <th>Di Buat</th>
                            <th>Di Update</th>
                            <th>Action</th>
                        </tr>
                        <?php $no = 1;?>
                    </thead>
                    @foreach ($data as $d )
                    <tbody>
                        <td>{{$no++}}</td>
                        <td>{{$d->id_user}}</td>
                        <td>{{$d->alamat}}</td>
                        <td>{{$d->metode}}</td>
                        <td>{{$d->kurir}}</td>
                        <td>{{$d->resi}}</td>
                        @if ($d->status == 1)
                            <td><i class="fas fa-check"></i> Sudah Bayar</td>
                        @else
                            <td><i class="fas fa-times"></i> Belum Bayar</td>
                        @endif
                        <td>{{$d->created_at}}</td>
                        <td>{{$d->updated_at}}</td>
                        <td>
                            <a href="/pembayaran/edit/{{$d->id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                            <a href="/pembayaran/hapus/{{$d->id}}" onclick="alert()" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
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
