<?php 
	session_start();
	// cek apakah yang mengakses halaman ini sudah login
	if($_SESSION['role']==""){
		header("location:index.php?pesan=gagal");
	}
	include "../config/koneksi.php";

$id_trx = $_GET['id_transaksi'];

$data = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_trx'");
$trx = mysqli_fetch_assoc($data);

$detail = mysqli_query($koneksi, "SELECT transaksi_detail.*, barang.nama FROM transaksi_detail INNER JOIN barang ON transaksi_detail.kode_barang=barang.kode_barang WHERE transaksi_detail.id_transaksi='$id_trx'");

?>


<!DOCTYPE html>
<html>
<head>
	<title>Kasir Selesai</title>
	<style type="text/css">
		body{
			color: #a7a7a7;
		}
	</style>
</head>
<body onload="window.print(); self.close();">
	<div align="center">
		<table width="500" border="0" cellpadding="1" cellspacing="0">
			<tr>
				<th>Toko KITA <br>
					JL diponegoro No. 123 <br>
				Praya, Lombok Tengah</th>
			</tr>
			<tr align="center"><td><hr></td></tr>
			<tr>
			<?=date('d-m-Y H:i:s', strtotime($trx['tanggal']))?> <?=$trx['nama']?></td>
			</tr>
			<tr><td><hr></td></tr>
		</table>
		<table width="500" border="0" cellpadding="3" cellspacing="0">
			<?php while ($row = mysqli_fetch_array($detail)) { ?>
			<tr>
				<td valign="top">
					<?=$row['nama']?>
					<?php if ($row['diskon'] > 0): ?>
					<br>
					<small>Diskon</small>
					<?php endif; ?>
				</td>
				<td valign="top"><?=$row['qty']?></td>
				<td  valign="top" align="right"><?=number_format($row['harga'])?></td>
				<td valign="top" align="right">
					<?=number_format($row['total'])?>
					<?php if ($row['diskon'] > 0): ?>
					<br>
					<small>-<?=number_format($row['diskon'])?></small>
					<?php endif; ?>
				</td>
			</tr>
			<?php } ?>
			<tr>
				<td colspan="4"><hr></td>
			</tr>
			<tr>
				<td align="right" colspan="3">Total</td>
				<td align="right"><?=number_format($trx['total'])?></td>
			</tr>
			<tr>
				<td align="right" colspan="3">Bayar</td>
				<td align="right"><?=number_format($trx['bayar'])?></td>
			</tr>
			<tr>
				<td align="right" colspan="3">Kembali</td>
				<td align="right"><?=number_format($trx['kembalian'])?></td>
			</tr>
		</table>
		<table width="500" border="0" cellpadding="1" cellspacing="0">
			<tr><td><hr></td></tr>
			<tr>
				<th>Terimkasih, Selamat Belanja Kembali</th>
			</tr>
			<tr>
				<th>===== Layanan Konsumen ====</th>
			</tr>
			<tr>
				<th>SMS/CALL 085895986529 </th>
			</tr>
		</table>
	</div>
</body>
</html>