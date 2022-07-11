<?php
session_start();
if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
}
include "../config/koneksi.php";

$kode_barang = $_POST['kode_barang'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];
$qty = $_POST['qty'];
$insert_data = mysqli_query($koneksi, "INSERT INTO barang (kode_barang,nama,ukuran,harga,qty)Values('$kode_barang','$nama','$harga','$qty')");

if ($insert_data) {
header('location:data_barang.php?pesan=Data Berasil Di simpan');
} else {
header('location:data_barang.php?pesan=Data Gagal Di simpan');
}