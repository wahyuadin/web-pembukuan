<?php $no=1;
    function id($id)
    {
        $data =  DB::table('users')->where('id_user', $id)->get();
        foreach ($data as $d) {
            return $d->name;
        }
    }
    function rp($angka)
    {
        $hasil = "Rp " . number_format($angka,2,',','.');
        return $hasil;
}?>
<!-- Content Row -->
<div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Transaksi</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data->count()}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="far fa-clipboard fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Data PEMASUKAN
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ rp($data->sum('pemasukan')) }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-money-bill-alt fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-4 col-md-3 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Data Pengeluaran</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ rp($data->sum('pengeluaran')) }}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->
<div class="row">

    <!-- Area Chart -->
    <div class="col-xl-12 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div
                class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Data Transaksi</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body shadow">
                <div class="card p-3 mb-4">
                    {{-- awal table --}}
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>No Nota</th>
                                        <th>Pelapor</th>
                                        <th>Nama Transaksi</th>
                                        <th>Kategori</th>
                                        <th>Pemasukan</th>
                                        <th>Pengeluaran</th>
                                        <th>Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $d )
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$d->tanggal}}</td>
                                        <td>{{$d->nota}}</td>
                                        <td>{{id($d->id_user)}}</td>
                                        <td>{{$d->nama}}</td>
                                        <td>{{$d->kategori}}</td>
                                        <td>{{rp($d->pemasukan)}}</td>
                                        <td>{{rp($d->pengeluaran)}}</td>
                                        <td>{{$d->catatan}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    {{-- akhir table --}}
                </div>
            </div>
        </div>
    </div>
</div>
