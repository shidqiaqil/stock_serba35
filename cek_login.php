<?php 
// mengaktifkan session php
session_start();
 
// menghubungkan dengan koneksi
include 'connect.php';
 
// menangkap data yang dikirim dari form
$id_user = $_POST['id_user'];
$pass_user = $_POST['pass_user'];
 
// menyeleksi data admin dengan username dan password yang sesuai
$data = mysqli_query($koneksi,"select * from auth_user where id_user='$id_user' and pass_user='$pass_user'");
 
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);
 
if($cek > 0){
	$_SESSION['id_user'] = $id_user;
	$_SESSION['status'] = "login";
	header("location:index.php");
}else{
	header("location:login.php?pesan=gagal");
	echo "<script>
 	alert('Anda belum login')";
}
?>