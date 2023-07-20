@extends('layout.app')

@section('judul', 'Tambah Buku')
@section('buku','active')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h1 class="h3 mb-4 text-gray-800">@yield('judul')</h1>
     <div class="card p-3">
        <form class="row g-3 p-4" method="POST" action="/buku/tambah/simpan" enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
              <label for="inputEmail4" class="form-label">ID Buku</label>
              <input type="text" name="id_buku" value="{{$kodeid}}" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Nama Buku *</label>
              <input type="text" name="nama_buku" value="{{old('nama_buku')}}" class="form-control" id="inputPassword4" placeholder="Nama Buku">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">ISBN *</label>
              <input type="text" name="isbn" value="{{old('isbn')}}" class="form-control" placeholder="ISBN">
            </div>
            <div class="col-md-3">
                <label for="inputCity" class="form-label">Penulis *</label>
                <input type="text" name="penulis" {{old('penulis')}} class="form-control" placeholder="Penulis">
              </div>
            <div class="col-md-3">
                <label for="inputCity" class="form-label">Stok Buku *</label>
                <input type="text" name="stok" {{old('stok')}} class="form-control" placeholder="Stok">
              </div>
            <div class="col-md-3">
                <label for="inputState" class="form-label">Harga *</label>
                <input type="text" name="harga" value="{{old('harga')}}" class="form-control" placeholder="Harga">
              </div>
            <div class="col-md-3">
                <label for="inputZip" class="form-label">Tanggal terbit *</label>
                <input type="date" value="{{old('tgl_terbit')}}" name="tgl_terbit" class="form-control" placeholder="Tanggal Terbit">
              </div>
            <div class="col-12">
              <label for="inputAddress" class="form-label">Upload Gambar</label>
              <input type="file" value="{{old('gambar')}}" name="gambar" class="form-control" required>
              <p style="color:red">Format Gambar Berupa *jpg | png | jpeg dengan file max 5MB</p>
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
