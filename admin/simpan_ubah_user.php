<?php
session_start();
if ($_SESSION['status'] != "sudah_login") {
//melakukan pengalihan
header("location:../login/login.php");
}
include "../config/koneksi.php";
$id_user = $_POST['id_user'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];
$update_data = mysqli_query($koneksi, "UPDATE user set nama='$nama',username='$username',password='$password',role='$role' where id_user=$id_user");
if ($update_data) {
header('location:data_user.php?pesan=Data Berasil Di Ubah');
} else {
header('location:data_user.php?pesan=Data Gagal Di Ubah');
}