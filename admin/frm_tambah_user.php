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
    <h1 class="h2">Form Tambah Data user</h1>
</div>
<!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380">
</canvas> -->
<!-- <h4>Data Jadwal Kegiatan</h4> -->
<div class="table-responsive">
    <form action="simpan_user.php" method="POST">
        <div class="col-6">
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="formlabel">Nama user</label>
                <input type="text" name="nama" class="form-control"
                placeholder="Nama user">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="formlabel">Username</label>
                <input type="text" name="username" class="form-control"
                placeholder="Username">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="formlabel">Password</label>
                <input type="text" name="password" class="form-control"
                placeholder="Password">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="formlabel">Role</label>
                <select name="role" class="form-control" id="">
                        <option value=""> Pilih Role</option>
                        <option value="admin">admin</option>
                        <option value="kasir">kasir</option>
                        </select>
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