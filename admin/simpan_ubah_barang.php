<?php
session_start();
if ($_SESSION['status'] != "sudah_login") {
//melakukan pengalihan
header("location:../login/login.php");
}
include "../config/koneksi.php";
$kode_barang = $_POST['kode_barang'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];
$update_data = mysqli_query($koneksi, "UPDATE barang set nama='$nama',harga='$harga',qty='$qty' where kode_barang=$kode_barang");
if ($update_data) {
header('location:data_barang.php?pesan=Data Berasil Di Ubah');
} else {
header('location:data_barang.php?pesan=Data Gagal Di Ubah');
}