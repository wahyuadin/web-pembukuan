@extends('layout.app')

@section('judul', 'Tambah Data Transaksi')
@section('transaksi','active')

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
        <form class="row g-3 p-4" method="POST" action="/transaksi/tambah/simpan">
            @csrf
            <div class="col-md-12">
              <label for="inputEmail4" class="form-label">Nama Transaksi</label>
              <input type="text" name="nama" value="{{old('nama')}}" class="form-control" placeholder="Masukan nama">
            </div>
            <div class="col-md-12">
              <label for="inputEmail4" class="form-label">Nomor Nota</label>
              <input type="text" name="nota" value="{{old('nota')}}" placeholder="Masukan Nomer nota" class="form-control">
            </div>
            <div class="col-md-12">
              <label class="form-label">Pengeluaran</label>
              <input name="pengeluaran" type="number" class="form-control" value="{{old('pengeluaran')}}" placeholder="Masukan Pengeluaran">
            </div>
            <div class="col-md-12">
              <label class="form-label">Pemasukan</label>
              <input name="pemasukan" type="number" value="{{old('pemasukan')}}" class="form-control" placeholder="Masukan Pemasukan">
            </div>
            <div class="col-md-6">
              <label class="form-label">Kategori</label>
                <select name="kategori" class="form-select" required>
                <option disabled selected style="text-align: center">== Pilih Salah Satu ==</option>
                @foreach ($data as $d)
                    <option value="{{$d->nama}}">{{$d->nama}}</option>
                @endforeach
                </select>
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Tanggal Transaksi</label>
              <input type="date" name="tanggal" value="{{old('tanggal')}}" class="form-control" placeholder="tanggal">
            </div>
            <div class="col-md-12">
              <label class="form-label">Catatan</label>
              <textarea name="catatan" class="form-control" placeholder="Catatan" style="height: 140px">{{old('catatan')}}</textarea>
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
