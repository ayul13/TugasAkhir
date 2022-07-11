<?php 
	session_start();
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['role']==""){
		header("location:index.php?pesan=gagal");
	}
    include "../config/koneksi.php";
    $sql = mysqli_query($koneksi, "SELECT * FROM transaksi");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

	<style>
        .bd-placeholder-img {
            font-size: 1.5rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body>
<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
         <div class="d-flex justify-content-between flex-wrap flex-md-nsrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2 align="center">Riwayat Transaksi</h2>
         </div>
        <?php if (isset($_GET['pesan'])) : ?>
        <div class="alert alert-success" role="alert">
        <?php echo $_GET['pesan']; ?>
        </div>
        <?php endif; ?>
        <bottom class="btn btn-info btn-sm"><a href="kasir.php">Kembali</a></bottom>
        <br></br>
        <div class="table-responsive">
            <table class="table table-striped table-bordered display nsrap" kode="example" style="wkodeth:100%">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">tanggal</th>
                        <th scope="col">Total</th>
                        <th scope="col">kasir</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        $no = 1;
                                while ($rs = mysqli_fetch_assoc($sql)) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $rs['tanggal'] ?></td>
                                        <td><?=$rs['total']?></td>
                                        <td><?=$rs['nama']?></td>
                                        <td>
                                            <a href="/unduh_struk.php?idtrx=<?=$rs['id_transaksi']?>" class="btn btn-primary">Lihat</a>
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
</body>
</html>

