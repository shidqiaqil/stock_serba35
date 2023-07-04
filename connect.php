<?php 
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'stock_serba35';
// Create connection
$koneksi = mysqli_connect($servername, $username, $password, $db);
 // Check connection
if (!$koneksi) {
	die ("connection failed.". mysqli_connect_error()); //close connection
}
 ?>