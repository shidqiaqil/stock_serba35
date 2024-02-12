<?php
include('connect.php');
$id = $_GET['id_barang_keluar'];

mysqli_query($koneksi, "delete from barang_keluar where id_barang_keluar='$id'");

echo "<script>
	alert('Data berhasil di hapus');
	window.location.href='barangkeluar.php';
	</script>";