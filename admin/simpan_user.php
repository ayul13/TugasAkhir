<?php
session_start();
if($_SESSION['role']==""){
    header("location:index.php?pesan=gagal");
}
include "../config/koneksi.php";

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
$insert_data = mysqli_query($koneksi, "INSERT INTO user (nama,username,password,role)Values('$nama','$username','$password','$role')");

if ($insert_data) {
header('location:data_user.php?pesan=Data Berasil Di simpan');
} else {
header('location:data_user.php?pesan=Data Gagal Di simpan');
}