<?php 
	session_start();
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['role']==""){
		header("location:index.php?pesan=gagal");
	}
	include "../config/koneksi.php";
	$barang = mysqli_query($koneksi, "SELECT * FROM barang");
// // print_r($_SESSION);

$sum = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        $sum += ($value['harga'] * $value['qty']) - $value['diskon'];
    }
}

	?>

<!DOCTYPE html>
<html>
<head>
<title>Kasir</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.88.1">
   

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <!-- <link href="../assets/css/bootstrap.min.css" rel="stylesheet"> 
    <link href="../assets/datatable/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../assets/datatable/css/responsive.dataTables.min.css" rel="stylesheet"> -->

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
<!-- <header class="navbar navbar-success sticky-top bg-success flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Aplikasi Kasir</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="../login/logout.php">Sign out</a>
            </div>
        </div>
    </header> -->

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Kasir</h1>
			<h2>Hai <?=$_SESSION['nama']?></h2>
			<a href="../login/logout.php">Logout</a> |
			<a href="riwayat_transaksi.php">Riwayat Transaksi</a>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-8">
			<form method="post" action="keranjang_act.php">
				<div class="form-group">
					<input type="text" name="kode_barang" class="form-control" placeholder="Masukkan kode Barang" autofocus>
					<select name="kode_barang" class="form-control" kode_barang="" >
                    <?php
                    while ($rs = mysqli_fetch_assoc($barang)) : ?>
                    <option value="<?= $rs['kode_barang']; ?>"> <?=$rs['kode_barang']; ?></option>
                    <?php endwhile; ?>
                </select>
				</div>
			</form>
			<br>
			<form method="post" action="keranjang.php">
			<table class="table table-bordered">
				<tr>
					<th>Nama</th>
					<th>Harga</th>
					<th>Qty</th>
					<th>Sub Total</th>
					<th></th>
				</tr>
				<?php if (isset($_SESSION['cart'])): ?>
				<?php foreach ($_SESSION['cart'] as $key => $value) { ?>
					<tr>
						<td>
							<?=$value['nama']?>
							
						</td>
						<td align="right"><?=number_format($value['harga'])?></td>
						<td class="col-md-2">
							<input type="number" name="qty[<?=$key?>]" value="<?=$value['qty']?>" class="form-control">
						</td>
						<td align="right"><?=number_format(($value['qty'] * $value['harga'])-$value['diskon'])?></td>
						<td><a href="keranjang_hapus.php?id=<?=$value['id']?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a></td>
					</tr>
				<?php } ?>
				<?php endif; ?>
			</table>
			<button type="submit" class="btn btn-success">Perbarui</button>
			</form>
		</div>
		<div class="col-md-4">
			<h3>Total Rp. <?=number_format($sum)?></h3>
			<form action="transaksi_act.php" method="POST">
				<input type="hidden" name="total" value="<?=$sum?>">
			<div class="form-group">
				<label>Bayar</label>
				<input type="text" id="bayar" name="bayar" class="form-control">
			</div>
			<button type="submit" class="btn btn-primary">Selesai</button>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">

	//inisialisasi inputan
	var bayar = document.getElementById('bayar');

	bayar.addEventListener('keyup', function (e) {
        bayar.value = formatRupiah(this.value, 'Rp. ');
        // harga = cleanRupiah(dengan_rupiah.value);
        // calculate(harga,service.value);
    });

    //generate dari inputan angka menjadi format rupiah

	function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    //generate dari inputan rupiah menjadi angka

    function cleanRupiah(rupiah) {
        var clean = rupiah.replace(/\D/g, '');
        return clean;
        // console.log(clean);
    }
</script>
	
</body>
</html>

