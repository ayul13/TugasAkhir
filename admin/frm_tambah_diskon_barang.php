<?php
session_start();
// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
}
include "../layout/header.php";
include "../config/koneksi.php";
?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap alignitems-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Form Tambah Data Diskon Barang</h1>
</div>
<!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380">
</canvas> -->
<!-- <h4>Data Jadwal Kegiatan</h4> -->
<div class="table-responsive">
    <form action="simpan_diskon_barang.php" method="POST">
        <div class="col-6">
        <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="formlabel">Kode Diskon Barang</label>
                <input type="text" name="kode_barang" class="form-control"
                placeholder="Kode Barang">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="formlabel">Qty</label>
                <input type="text" name="qty" class="form-control"
                placeholder="Qty">
                <div class="mb-3">
                <label for="exampleFormControlInput1" class="formlabel">diskon</label>
                <input type="text" name="diskon" class="form-control"
                placeholder="diskon">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
</main>
<?php
include "../layout/footer.php";
?>