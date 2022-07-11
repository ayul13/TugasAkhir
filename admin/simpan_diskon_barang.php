<?php
session_start();
if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
}
include "../config/koneksi.php";

$kode_barang = $_POST['kode_barang'];
$qty = $_POST['qty'];
$diskon = $_POST['diskon'];

$insert_data = mysqli_query($koneksi, "INSERT INTO diskon_barang (kode_barang,qty,diskon)Values('$kode_barang','$qty','$diskon')");

if ($insert_data) {
header('location:data_diskon_barang.php?pesan=Data Berasil Di simpan');
} else {
echo mysqli_error($koneksi);
//header('location:data_diskon_barang.php?pesan=Data Gagal Di simpan');
}