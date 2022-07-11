<?php
    session_start();
    if ($_SESSION['status'] != "sudah_login") {
    //melakukan pengalihan
    header("location:../login/login.php");
}
include "../config/koneksi.php";
$kode_barang = $_GET['kode_barang'];
$query = mysqli_query($koneksi, "DELETE FROM barang where kode_barang=$kode_barang");

if ($query) {
 header('location:data_barang.php?pesan=Data Berasil Di Hapus');
} else {
 header('location:data_barang.php?pesan=Data Gagal Di Hapus');
}