@extends('layout.app')

@section('judul', 'Halaman Laporan')
@section('laporan','active')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">@yield('judul')</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
        <div class="card-header py-3">
            <form action="" method="post" class="row g-3">
                @csrf
                    <h5>Filter Laporan</h5>
                    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
                    <div class="col-md-5">
                      <label class="form-label">Mulai Tanggal</label>
                      <input type="date" name="mulai" value="{{old('nama')}}" class="form-control" placeholder="Masukan nama">
                    </div>
                    <div class="col-md-5">
                      <label class="form-label">Sampai Tanggal</label>
                      <input type="date" name="akhir" value="{{old('nama')}}" class="form-control" placeholder="Masukan nama">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mb-4"></label>
                        <button class="btn btn-primary form-control" type="submit" name="filter">Tampilkan</button>
                    </div>
            </form>
        </div>

        <div class="card-header">
            <h5>Laporan Pemasukan & Pengeluaran</h5>
                <br>
                <div class="row g-3">
                    <div class="col-md-2">
                        <p><b>Dari Tanggal</b></p>
                    </div>
                    <div class="col-md-9">
                             <p>: {{$mulai}}</p>
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col-md-2">
                        <p><b>Samppai Tanggal</b></p>
                    </div>
                    <div class="col-md-9">
                        <p>: {{$akhir}}</p>
                    </div>
                </div>
                <form action="" method="post">
                    @csrf
                    <button type="sumbit" name="pdf" class="btn btn-info"><i class="fas fa-print"></i> Print</button>
                </form>
                <hr>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th colspan="2" style="text-align: center">Jenis</th>
                        </tr>
                      <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>No Nota</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Catatan</th>
                            <th>Pemasukan</th>
                            <th>Pengeluaran</th>
                      </tr>
                    </thead>
                    <?php
                    $no=1;
                    function rp($angka)
                    {
                        $hasil = "Rp " . number_format($angka,2,',','.');
                        return $hasil;
                    }?>
                    <tbody>
                      <tr>
                          @foreach ($data as $d)
                            <th scope="row">{{$no++}}</th>
                            <td>{{$d->nama}}</td>
                            <td>{{$d->nota}}</td>
                            <td>{{$d->tanggal}}</td>
                            <td>{{$d->kategori}}</td>
                            <td>{{$d->catatan}}</td>
                            <td>{{rp($d->pemasukan)}}</td>
                            <td>{{rp($d->pengeluaran)}}</td>
                        </tr>
                        @endforeach
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>TOTAL :</b></td>
                        <td style="color: green">{{rp($totalmasuk)}}</td>
                        <td style="color: red">{{rp($totalkeluar)}}</td>
                      </tr>
                      <?php
                            $jumlahsemua = $totalmasuk - $totalkeluar;
                            ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>SALDO :</b></td>
                        <td colspan="2" style="text-align: center">{{rp($jumlahsemua)}}</td>
                    </tbody>
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
