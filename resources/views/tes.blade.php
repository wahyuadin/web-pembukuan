<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latihan Form Filter Data</title>
    <!-- bootstrap css  -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<br>
<?php
if (isset($_POST['provinsi'])) {
    var_dump($_POST['provinsi']);
    die;
    $cari = $_POST['provinsi'];
} else {
    $data = [];
}
?>
    <div class="container jumbotron">
    <!-- membuat form dropdown jurusan dengan id = form_id -->
        <form action=""  method="GET" id="submit">
            <div class="form-group">
                <label for="exampleInputEmail1">Provinsi</label>
                <!-- gunakan event onchange untuk mengirim data secara otomatis  -->
                <select class="form-control" name="provinsi" onChange="document.getElementById('submit').submit();">
                    <option selected disabled>--Pilih Provinsi--</option>
                    <?php
                        $api = file_get_contents('http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json');
                        $api = json_decode($api, true);
                    foreach ($api as $d) { ?>
                    <option  <?php if(!empty($cari)){ echo $cari == $d['id'] ? 'selected':''; } ?> value="{{ $d['id'] }}">{{ $d['name'] }}</option>
                    <?php } ?>
                </select>
            </div>
            <hr>
            <div class="form-group">
                <label for="exampleInputPassword1">Nama Mahasiswa</label>
                <select class="form-control">
                    <option value="">--Pilih Mahasiswa--</option>
                    <!-- data ditampilkan berdasarkan jurusan yang dipilih
                    untuk logikanya ada pada line 24 hingga 33 -->

                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>
