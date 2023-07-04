<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link  href="assets/fontawesome/css/all.min.css" rel="stylesheet">
    <!-- <link href="assets/css/index.css" rel="stylesheet"> -->
    

    <!-- <link rel="stylesheet" href = "assets/sbsadmin/DataTables/jquery.dataTables.min.css"> -->
    <script src="assets/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="assets/js/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/jquery.dataTables.min.css">

    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    <title>Halaman Utama</title>
</head>

<?php 
    include 'connect.php';
	session_start();
	if($_SESSION['status']!="login"){
		header("location:index.php?pesan=belum_login");
	}
    $userid = $_SESSION['id_user'];

?>

<body>
 <!--Main Navigation-->

 <style>
    .table-container {
      border: 1px solid #ced4da;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      padding: 1%;
      background-color: #f8f9fa;
    }
  </style> 
<body>  
<div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="border-end bg-white" id="sidebar-wrapper">
                <div class="sidebar-heading border-bottom bg-light"><strong>SERBA 35.000!</strong></div>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 active" href="index.php" >Barang Masuk</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="barangkeluar.php">Barang Keluar</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="logout.php">Keluar</a>
                    
                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-primary" id="sidebarToggle">Menu</button>
                        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button> -->
                        
                    </div>
                </nav>
                <?php
                date_default_timezone_set('Asia/Bangkok');
                $date = date('Y-m-d H:i:s');
                // $stok = mysqli_query($koneksi,"select total_stock from stock ORDER BY created_timestamp DESC LIMIT 1");
                $stokplus  = mysqli_query($koneksi,"select sum(total_barang_masuk) from barang_masuk");
                $stokminus = mysqli_query($koneksi,"select sum(total_barang_keluar) from barang_keluar");
                $finalstok = mysqli_query($koneksi, "SELECT (SELECT SUM(total_barang_masuk) FROM barang_masuk) - (SELECT SUM(total_barang_keluar) FROM barang_keluar) as difference");
                if ($finalstok) {
                    // Fetch the result as an associative array
                    $row = mysqli_fetch_assoc($finalstok);
                
                    // Access the calculated difference
                    $difference = $row['difference']; }
                
                if($_POST){
                        try {
                            $sql = "INSERT INTO barang_masuk 
                            (id_barang_masuk,created_timestamp_barang_masuk, id_user, total_barang_masuk)
                            VALUES ('','$date','$userid','".$_POST['total_barang_masuk']."')";
                            
                            if(!$koneksi->query($sql)){
                                echo $koneksi->error;
                                die();
                            }

                        } catch (Exception $e) {
                            echo $e;
                            die();
                        }
                        echo "<script>
                        alert('Data berhasil di input');
                        window.location.href='index.php';
                        </script>";
                    }
                
                
                ?>
                <!-- Page content-->
                <div class="container-fluid">
                    <h4 class="mt-4">Sisa Stok Barang : <Strong style="color:green"><?php echo $difference; ?></Strong></h4>
                    <br>
                    <br>
                    <div class="row">
                        <h6>Total Barang Masuk</h6>
                        <div class="col-md-6 ">
                            <form  method="post">
                            <div class="input-group">
                                <input type="text" class="form-control" pattern="[0-9]+" placeholder="Masukkan Angka" name="total_barang_masuk" required>
                                <div style="margin-left: 3%;">
                                    <button class="btn btn-primary" type="submit" >Submit</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                
                    <br>

                    <div class="table-container">
                        <h4>Riwayat Total Barang Masuk</h4>
                        <br>
                    
                        <table id="dataTable" class="table  table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                <th>ID Admin</th>
                                <th>Tanggal Barang Masuk</th>
                                <th>Total Barang Masuk</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                        
                                $data = mysqli_query($koneksi,"select * from barang_masuk");
                                $no = 1;
                                
                                while($d = mysqli_fetch_array($data)){
                                ?>    
                                    <tr class="text-center">
                                        <td><?php echo $d['id_user']; ?></td>
                                        <td><?php $orgDate = $d['created_timestamp_barang_masuk'];  
                                                    $newDate = date("d/m/Y H:i", strtotime($orgDate));  
                                                    echo  $newDate;   ?> </td>
                                        <td><?php echo $d['total_barang_masuk']; ?></td>
                                
                                    </tr>
                                    <?php
                                }
                                ?>
                                <!-- Add more rows here -->
                            </tbody>
                            <tfoot>
                            <?php 
                                
                                $data7 = mysqli_query($koneksi,"select sum(total_barang_masuk) as total from barang_masuk");
                                $total = mysqli_fetch_array($data7);
                                
                                
                                
                            ?>
                                <tr class="text-center">
                                    <th  scope="row">Total</th>
                                    <!-- <td>Web-Development Bundle</td> -->
                                    <td></td>
                                    <td><b><?php echo $total['total'] ?></b></td>
                                    
                                    
                                    <!-- <td><a href="checkout.php">Checkout</a></td> -->
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    
                </div>
                </div>
            </div>
        </div>
        <script src="js/scripts.js"></script>
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
        <!-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> -->

        <script  src="assets/js/jquery-3.6.0.min.js"></script>
        <script  src="assets/js/jquery.dataTables.min.js"></script>
        
        <script>
            $(document).ready(function() {
            $('#dataTable').DataTable();
            });
        </script>
</body>  
</html>  
