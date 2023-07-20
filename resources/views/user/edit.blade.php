
@extends('layout.app')

@section('judul', 'Edit Order')
@section('pembayaran','active')

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
        <form class="row g-3 p-4" method="POST" action="/user/edit/simpan">
            @csrf
            @foreach ($data as $d )
            <div class="col-md-12">
              <label for="inputEmail4" class="form-label">ID User</label>
              <input type="text" name="id_user" value="{{$d->id_user}}" class="form-control" readonly>
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Nama User</label>
              <input type="text" name="name" value="{{$d->name}}" class="form-control" id="inputPassword4" placeholder="Nama Buku">
            </div>
            <div class="col-md-6">
              <label for="inputPassword4" class="form-label">Alamat Email</label>
              <input type="email" name="email" value="{{$d->email}}" class="form-control" placeholder="Email">
            </div>
            <div class="col-md-4">
                <label for="inputCity" class="form-label">Role</label>
                <select name="role" class="form-control">
                    <option selected disabled>== Pilih Salah Satu ==</option>
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
              </div>
            <div class="col-md-8">
                <label for="inputCity" class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-control" placeholder="Password Baru" required>
              </div>
            @endforeach
            <div class="col-12">
              <button type="submit" class="btn btn-primary">Kirim</button>
            </div>
          </form>
     </div>
</div>
</div>


<!-- End of Main Content -->
@endsection
