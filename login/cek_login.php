<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../config/koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];


// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if($data['role']=="admin"){

		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['role'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:../admin/dashboard.php");

	// cek jika user login sebagai kasir
	}else if($data['role']=="kasir"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['role'] = "kasir";
		// alihkan ke halaman dashboard kasir
		header("location:../kasir/kasir.php");

	}else{

		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
	}

	
}else{
	header("location:index.php?pesan=gagal");
}



?>