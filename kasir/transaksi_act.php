<?php 
	session_start();
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['role']==""){
		header("location:index.php?pesan=gagal");
	}
	include "../config/koneksi.php";

//menghilangkan Rp pada nominal
$bayar = preg_replace('/\D/', '', $_POST['bayar']);
// print_r(preg_replace('/\D/', '', $_POST['total']));

// print_r($_SESSION['cart']) ;

$tanggal = date('Y-m-d H:i:s');
$total = $_POST['total'];
$nama = $_SESSION['nama'];
$kembalian = $bayar - $total;


//insert ke tabel transaksi
mysqli_query($koneksi, "INSERT INTO transaksi (id_transaksi,tanggal,nama,total,bayar,kembalian) VALUES (NULL,'$tanggal','$total','$nama','$bayar','$kembalian')");

//mendapatkan id transaksi baru
$id_transaksi = mysqli_insert_id($koneksi);

//insert ke detail transaksi
foreach ($_SESSION['cart'] as $key => $value) {

	$kode_barang = $value['kode_barang'];
	$harga = $value['harga'];
	$qty = $value['qty'];
	$tot = $harga*$qty;
	$disk = $value['diskon'];

	mysqli_query($koneksi,"INSERT INTO transaksi_detail (id_transaksi_detail,id_transaksi,kode_barang,harga,qty,total,diskon) VALUES (NULL,'$id_transaksi','$kode_barang','$harga','$qty','$tot','$disk')");

	// $sum += $value['harga']*$value['qty'];
}

$_SESSION['cart'] = [];

//redirect ke halaman transaksi selesai
header("location:transaksi_selesai.php?id_transaksi=".$id_transaksi);



?>