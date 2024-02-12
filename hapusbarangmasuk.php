<?php
include('connect.php');
$id = $_GET['id_barang_masuk'];

mysqli_query($koneksi, "delete from barang_masuk where id_barang_masuk='$id'");

echo "<script>
	alert('Data berhasil di hapus');
	window.location.href='index.php';
	</script>";