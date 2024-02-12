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
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 " href="index.php" >Barang Masuk</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3" href="barangkeluar.php">Barang Keluar</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 " href="pengeluaran.php">Pengeluaran</a>
                    <a class="list-group-item list-group-item-action list-group-item-light p-3 active" href="profit.php">Profit</a>
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
            
                $stokplus = mysqli_query($koneksi, "SELECT SUM(total_barang_masuk) AS stokplus FROM barang_masuk WHERE id_user = '$userid'");
                $stokminus = mysqli_query($koneksi, "SELECT SUM(total_barang_keluar) AS stokminus FROM barang_keluar WHERE id_user = '$userid'");

                $finalstok = mysqli_query($koneksi, "SELECT (SELECT SUM(total_barang_masuk) FROM barang_masuk WHERE id_user = '$userid') - (SELECT SUM(total_barang_keluar) FROM barang_keluar WHERE id_user = '$userid') AS difference");
                
                if ($finalstok) {
                    // Fetch the result as an associative array
                    $row = mysqli_fetch_assoc($finalstok);

                    // Access the calculated difference
                    $difference = $row['difference'];
                }

             
                
                ?>
                <!-- Page content-->
                <div class="container-fluid">               
                    <br>

                    <div class="table-container">
                        <h4>Profit</h4>
                        <br>
                        <div class="col-md-6 ">
                                <form  method="post">
                                <div class="input-group">
                                    p
                                    <input type="date" class="form-control" placeholder="Dari Tanggal" name="start_date" value= "<?php echo isset($_POST['start_date']) ? $_POST['start_date'] : ''; ?>" required> &nbsp
                                    <input type="date" class="form-control" placeholder="Tanggal Tanggal" name="end_date" value="<?php echo isset($_POST['end_date']) ? $_POST['end_date'] : ''; ?>"required>
                                    <div style="margin-left: 3%;">
                                        <button class="btn btn-success" type="submit" >Cari</button>
                                    </div>
                                </div>
                                </form>
                        </div>
            </br>
                        <table id="dataTable" class="table  table-striped table-bordered">
                            <thead>
                                <tr class="text-center">
                                <th>Tanggal Penjualan</th>
                                <th>Total Barang Keluar</th>
                                <th>Total Penjualan</th>
                                <th>Total Pengeluaran</th>
                                <th>Total Profit</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $start_date=$_POST['start_date'];
                                $end_date=$_POST['end_date'];
                                $data = mysqli_query($koneksi,"SELECT
                                a.formatted_date AS formatted_date,
                                COALESCE(SUM(a.total_barang_keluar), 0) AS total_barang_keluar,
                                COALESCE(SUM(a.total_harga), 0) AS total_harga,
                                COALESCE(SUM(b.total_pengeluaran), 0) AS total_pengeluaran,
                                COALESCE(SUM(a.total_harga), 0) - COALESCE(SUM(b.total_pengeluaran), 0) AS total_profit
                            FROM
                                (SELECT
                                    DATE(created_timestamp_barang_keluar) AS formatted_date,
                                    total_barang_keluar,
                                    total_harga
                                FROM
                                    barang_keluar
                                WHERE
                                    id_user = '$userid'
                                    AND DATE(created_timestamp_barang_keluar) BETWEEN '$start_date' AND '$end_date' -- Filter by date range
                                GROUP BY
                                    formatted_date) a
                            LEFT JOIN
                                (SELECT
                                    COALESCE(DATE(created_timestamp_pengeluaran), 0) AS formatted_date,
                                    SUM(total_pengeluaran) AS total_pengeluaran
                                FROM
                                    pengeluaran
                                WHERE
                                    id_user = '$userid'
                                    AND DATE(created_timestamp_pengeluaran) BETWEEN '$start_date' AND '$end_date' -- Filter by date range
                                GROUP BY
                                    formatted_date) b ON a.formatted_date = b.formatted_date
                            GROUP BY
                                a.formatted_date;
                            ;
                            ");
                                $no = 1;
                                
                                while($d = mysqli_fetch_array($data)){
                                ?>    
                                    <tr class="text-center">
                                        
                                        <td><?php $orgDate = $d['formatted_date'];  
                                                    $newDate = date("d/m/Y", strtotime($orgDate));  
                                                    echo  $newDate;   ?> </td>
                                        <td><?php echo $d['total_barang_keluar']; ?></td>
                                        <td>Rp <span><?php echo $d['total_harga']; ?></span></td>
                                        <td><?php echo "Rp "; echo $d['total_pengeluaran']; ?></td>
                                        <td><?php echo "Rp ";  echo $d['total_profit']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <!-- Add more rows here -->
                            </tbody>
                            <tfoot>
                            <?php                                 
                                // $data7 = mysqli_query($koneksi,"select id_user, 35000 * SUM(a.total_barang_keluar) as total from barang_keluar WHERE id_user = '$userid'");
                                // $total = mysqli_fetch_array($data7);
                            ?>
                            <!--  
                                <tr class="text-center">
                                    <th  scope="row">Total</th>
                                    <!-- <td>Web-Development Bundle</td> -->
                                    <td></td>
                                    <!-- <td><b><?php echo $total['total'] ?></b></td> -->
                                    <td></td>
                                    
                                    <!-- <td><a href="checkout.php">Checkout</a></td> -->
                                </tr> 
                            </tfoot>
                        </table>
                    </div>
                    
                </div>
                </div>
            </div>
        </div>
        <!-- Modal -->



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
