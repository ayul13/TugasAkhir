<?php 
	session_start();
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['role']==""){
		header("location:index.php?pesan=gagal");
	}
	include "../config/koneksi.php";

$kode_barang = $_GET['kode_barang'];

$cart = $_SESSION['cart'];
// print_r($cart);

//berfungsi untuk mengambil data secara spesifik
$k = array_filter($cart,function ($var) use ($kode_barang){
	return ($var['kode_barang']==$kode_barang);
});
print_r($k);

foreach ($k as $key => $value) {
	unset($_SESSION['cart'][$key]);
}

//mengembalikan urutan data
$_SESSION['cart'] = array_values($_SESSION['cart']);

header('location:kasir.php');

?>