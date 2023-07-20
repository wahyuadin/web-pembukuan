@extends('layout.app')

@section('judul', 'Edit Data Kategori')
@section('kategori','active')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">@yield('judul')</h1>
     <div class="card p-3">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
@endif
        <form class="row g-3 p-4" method="POST" action="/kategoriedit/simpan">
            @csrf
            <div class="col-md-12">
              <label for="inputEmail4" class="form-label">ID User</label>
              <input type="text" name="id_user" value="{{ $data[0]->id_user }}" class="form-control" readonly>
              <input type="text" name="id" value="{{ $data[0]->id }}" class="form-control" hidden>
            </div>
            <div class="col-md-12">
              <label for="inputPassword4" class="form-label">Nama</label>
              <input type="text" name="nama" value=" {{ $data[0]->nama }}" class="form-control" placeholder="Nama Kategori">
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
          </form>
     </div>
</div>
</div>


<!-- End of Main Content -->
@endsection
