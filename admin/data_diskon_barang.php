<?php
session_start();

// cek apakah yang mengakses halaman ini sudah login
if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
}
include "../layout/header.php";
include "../config/koneksi.php";
$sql = mysqli_query($koneksi, "SELECT * FROM diskon_barang");

?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Data Diskon Barang</h1>
         </div>
        <?php if (isset($_GET['pesan'])) : ?>
        <div class="alert alert-success" role="alert">
        <?php echo $_GET['pesan']; ?>
        </div>
        <?php endif; ?>
        
        <a href="frm_tambah_diskon_barang.php" class="btn btn-sm btn-primary">Tambah Data</button></a>
        <br> <br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered display nowrap" kode="example" style="wkodeth:100%">
            <thead class="table-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode Barang</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Diskon</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    $no = 1;
                            while ($rs = mysqli_fetch_assoc($sql)) : ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $rs['kode_barang']; ?></td>
                                    <td><?= $rs['qty']; ?></td>
                                    <td><?= $rs['diskon']; ?></td>
                                    <td>
                                        <a href="frm_ubah_diskon_barang.php?kode_barang=<?=$rs['kode_barang']; ?>"class="btn btn-info btn-sm">Ubah</a>
                                        <a href="hapus_diskon_barang.php?kode_barang=<?=$rs['kode_barang']; ?>" class=" btn btn-danger btn-sm">Hapus</a>
                                    </td>
                                </tr>
                    <?php
                    $no++;
                    endwhile;
                    ?>
                </tbody>
            </table>
        </div>
</main>
<?php
include "../layout/footer.php";
?>