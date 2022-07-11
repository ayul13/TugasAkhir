<?php 
	session_start();
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['role']==""){
		header("location:index.php?pesan=gagal");
	}
	include "../config/koneksi.php";

$qty = $_POST['qty'];
$cart = $_SESSION['cart'];

// print_r($qty);

foreach ($cart as $key => $value) {
    $_SESSION['cart'][$key]['qty'] = $qty[$key];

    $idbarang = $_SESSION['cart'][$key]['id'];
    //cek diskon barang
    $disbarang = mysqli_query($dbconnect, "SELECT * FROM diskon_barang WHERE barang_id='$idbarang'");
    $disb = mysqli_fetch_assoc($disbarang);

    //cek jika di keranjang sudah ada barang yang masuk
    $key = array_search($idbarang, array_column($_SESSION['cart'], 'id'));
    // return var_dump($key);
    if ($key !== false) {
        // return var_dump($_SESSION['cart']);

        //cek jika ada diskon dan cek jumlah barang lebih besar sama dengan minimum order diskon
        if ($disb['qty'] && $_SESSION['cart'][$key]['qty'] >= $disb['qty']) {

            //cek kelipatan jumlah barang dengan batas minimum order
            $mod = $_SESSION['cart'][$key]['qty'] % $disb['qty'];

            if ($mod == 0) {

                //Jika benar jumlah barang kelipatan batas minimum order
                $d = $_SESSION['cart'][$key]['qty'] / $disb['qty'];
            } else {

                //Simpan jumlah diskon yang didapat
                $d = ($_SESSION['cart'][$key]['qty'] - $mod) / $disb['qty'];
            }

            //Simpan diskon dengan jumlah kelipatan dikali diskon barang
            $_SESSION['cart'][$key]['diskon'] = $d * $disb['diskon'];
        }
    }
}

header('location:kasir.php');
