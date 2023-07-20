@extends('layout.app')

@section('judul', 'Halaman Kategori')
@section('kategori','active')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">@yield('judul')</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <span class="icon text-blue-50">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-plus"></i> Tambah data</button>
            </span>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        {{-- modal --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">@yield('judul')</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/kategori/simpan">
                        @csrf
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">ID User</label>
                            <input type="text" name="id_user" class="form-control" value="{{Auth::user()->id_user}}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Kategori baru</label>
                            <input type="text" name="nama" value="{{old('nama')}}" class="form-control" required placeholder="Masukan Kategori Baru">
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit">Kirim</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        {{-- end modal --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kategori</th>
                            @if (Auth::user()->role == "admin")
                            <th>Nama User</th>
                            <th>Status</th>
                            <th>ID User</th>
                                <th>Action</th>
                            @endif
                        </tr>
                        <?php $no = 1;?>
                    </thead>
                    @foreach ($data as $d)
                    <tbody>
                        <?php $sql = DB::table('users')->where('id_user', $d->id_user)->first()?>
                        <td>{{$no++}}</td>
                        <td>{{$d->nama}}</td>
                        @if (Auth::user()->role == "admin")
                        <td>{{$sql->name}}</td>
                        <td>{{$sql->role}}</td>
                        <td>{{$d->id_user}}</td>
                                <td>
                                    <a href="/kategori/edit/{{$d->id}}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="/kategori/hapus/{{$d->id}}" onclick="alert()" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
                                </td>
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
