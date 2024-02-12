<?php
include('connect.php');
$id = $_GET['id_pengeluaran'];

mysqli_query($koneksi, "delete from pengeluaran where id_pengeluaran='$id'");

echo "<script>
	alert('Data berhasil di hapus');
	window.location.href='pengeluaran.php';
	</script>";