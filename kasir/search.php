<?php 
	session_start();
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['role']==""){
		header("location:index.php?pesan=gagal");
	}
	include "../config/koneksi.php";
$return_arr = array();
$term = $_GET["term"];

$fetch = mysqli_query($koneksi,"SELECT * FROM barang WHERE nama LIKE '%$term%'"); 

while ($row = mysqli_fetch_array($fetch)) {
    $row_array['id'] = $row['kode_barang'];
    $row_array['label'] = $row['nama'];
    $row_array['desc'] = $row['harga'];
    $row_array['value'] = $row['nama'];

    array_push($return_arr,$row_array);   
}

echo json_encode($return_arr);