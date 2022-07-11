<?php
session_start();
if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
}
include "../layout/header.php";
include "../config/koneksi.php";
$kode_barang = $_GET['kode_barang'];
$query = mysqli_query($koneksi, "SELECT * FROM diskon_barang where kode_barang=$kode_barang");
$rs = mysqli_fetch_assoc($query);
?>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Form Data barang</h1>
            </div>
        <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380">
        </canvas> -->
        <!-- <h4>Data Jadwal Kegiatan</h4> -->
                <div class="table-responsive">
                   <form action="simpan_ubah_diskon_barang.php" method="POST">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Kode Barang</label>
                                <input type="text" name="kode_barang" value="<?=$rs['kode_barang']; ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Qty</label>
                                <input type="text" name="qty" value="<?= $rs['qty']; ?>" class="form-control">
                            </div> 
                             </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">diskon</label>
                                <input type="text" name="diskon" value="<?= $rs['diskon']; ?>" class="form-control">
                            </div> 
                                    <input type="hidden" value="<?= $kode_barang; ?>" name="kode_barang"$kode_barang="">
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