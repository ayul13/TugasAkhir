<?php
session_start();
if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
}
include "../layout/header.php";
include "../config/koneksi.php";
$id_user = $_GET['id_user'];
$query = mysqli_query($koneksi, "SELECT * FROM user where id_user=$id_user");
$rs = mysqli_fetch_assoc($query);
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Form Data user</h1>
            </div>
        <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380">
        </canvas> -->
        <!-- <h4>Data Jadwal Kegiatan</h4> -->
                <div class="table-responsive">
                   <form action="simpan_ubah_user.php" method="POST">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Nama user</label>
                                <input type="text" name="nama" value="<?=$rs['nama']; ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                <input type="text" name="username" value="<?=$rs['username']; ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Password</label>
                                <input type="text" name="password" value="<?= $rs['password'];?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Role</label>
                                <input type="text" name="role" value="<?= $rs['role']; ?>" class="form-control">
                            </div> 
                                    <input type="hidden" value="<?= $id_user; ?>" name="id_user"id_user="">
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