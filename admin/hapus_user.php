<?php
    session_start();
    if ($_SESSION['status'] != "sudah_login") {
    //melakukan pengalihan
    header("location:../login/login.php");
}
include "../config/koneksi.php";
$id_user = $_GET['id_user'];
$query = mysqli_query($koneksi, "DELETE FROM user where id_user=$id_user");

if ($query) {
 header('location:data_user.php?pesan=Data Berasil Di Hapus');
} else {
 header('location:data_user.php?pesan=Data Gagal Di Hapus');
}