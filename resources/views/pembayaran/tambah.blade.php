@extends('layout.app')

@section('judul', 'Tambah Data Order')
@section('order','active')

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
        <form class="row g-3 p-4" method="POST" action="/pembayaran/tambah/simpan">
            @csrf
            <div class="col-md-12">
              <label for="inputEmail4" class="form-label">Kode</label>
              <input type="text" name="id_user" value="{{$id_user}}" class="form-control" readonly>
            </div>
            <div class="col-md-12">
              <label for="inputPassword4" class="form-label">Nama</label>
              <input name="nama" class="form-control" value="{{Auth::user()->name}}" placeholder="Masukan Nama">
            </div>
            <div class="col-md-12">
              <label for="inputPassword4" class="form-label">Alamat</label>
              <textarea name="alamat" class="form-control" placeholder="Alamat" style="height: 132px;"></textarea>
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Metode Pembayaran</label>
                <select name="metode" class="form-control" required>
                <option disabled selected>== Pilih Salah Satu ==</option>
                    <option disabled>===========</option>
                    <option value="Tunai">Tunai</option>
                    <option value="E-Wallet">E-Wallet</option>
                    <option value="Credit">Credit</option>
                <option value="Lainnya">Lainnya</option>
                </select>
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Kurir</label>
              <input type="text" name="kurir" class="form-control" placeholder="Kurir">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">No Resi</label>
              <input type="text" name="resi" class="form-control" placeholder="Nomer Resi">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Status</label>
              <select name="status" class="form-control" required>
                <option disabled selected>== Pilih Salah Satu ==</option>
                <option disabled>===========</option>
                <option value="1">Sudah Bayar</option>
                <option value="0">Belum Bayar</option>
            </select>
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
