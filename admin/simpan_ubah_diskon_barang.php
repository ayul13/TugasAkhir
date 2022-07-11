<?php
session_start();
if ($_SESSION['status'] != "sudah_login") {
//melakukan pengalihan
header("location:../admin/data_diskon_barang.php");
}

include "../config/koneksi.php";
$kode_barang = $_POST['kode_barang'];
$qty = $_POST['qty'];
$diskon = $_POST['diskon'];
$update_data = mysqli_query($koneksi, "UPDATE diskon_barang set qty='$qty',diskon=$'diskon' where kode_barang=$kode_barang");
if ($update_data) {
header('location:data_diskon_barang.php?pesan=Data Berasil Di Ubah');
} else {
echo mysqli_error($koneksi);
//header('location:data_barang.php?pesan=Data Gagal Di Ubah');
}