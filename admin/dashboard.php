<?php 
	session_start();

	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['role']==""){
		header("location:index.php?pesan=gagal");
	}
    include "../layout/header.php";
    include "../config/koneksi.php";
	?>



<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Selamat Datang : <?php echo $_SESSION['nama']; ?></h1>

    </div>

    <!-- <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas> -->

    <h4>Halaman Ini masih dalam masa perkembangan!</h4>
    
    
</main>

<?php
include "../layout/footer.php";
?>