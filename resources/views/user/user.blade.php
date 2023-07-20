@extends('layout.app')

@section('judul', 'Halaman User')
@section('user','active')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">@yield('judul')</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            {{-- <span class="icon text-blue-50">
                <a href="/buku/tambah" class="btn btn-primary rounded"><i class="fas fa-plus"></i> Tambah Buku</a>
            </span> --}}

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>ID User</th>
                            <th>Email</th>
                            <th>Verif</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                        <?php $no = 1;?>
                    </thead>
                    @foreach ($data as $d)
                    <tbody>
                        <td>{{$no++}}</td>
                            <td>{{$d->name}}</td>
                            <td>{{$d->id_user}}</td>
                            <td>{{$d->email}}</td>
                            @if ($d->verif == '1')
                                <td>Sudah Verifikasi</td>
                            @else
                                <td>Belum Verifikasi</td>
                            @endif
                            <td>{{$d->role}}</td>
                            <td>
                                <a href="/user/edit/{{$d->id_user}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                <a href="/user/hapus/{{$d->id_user}}" onclick="alert()" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
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
