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
    <link href="assets/css/loginadmin.css" rel="stylesheet">
    
    <title>Login SIstem</title>
</head>

<!-- check login -->
<?php 
	if(isset($_GET['pesan'])){
		if($_GET['pesan'] == "gagal"){
			$message= "Login gagal! username dan password salah!";
            echo "<script type='text/javascript'>alert('$message');</script>";
		}else if($_GET['pesan'] == "logout"){
			$message= "Anda telah berhasil logout";
            echo "<script type='text/javascript'>alert('$message');</script>";
		}else if($_GET['pesan'] == "belum_login"){
			$message= "Anda harus login untuk mengakses halaman admin";
            echo "<script type='text/javascript'>alert('$message');</script>";
		}
	}
?>
<!-- ------------ -->
<body>
    <!-- Section: Design Block -->
    <!-- Section: Design Block -->
<!-- Section: Design Block -->
<section class="text-center">
  <!-- Background image -->
  <div class="p-5 bg-image" style="
        background-image: url('assets/img/171.jpg');
        height: 300px;
        "></div>
  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong" style="
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.8);
        backdrop-filter: blur(30px);
        ">
    <div class="card-body py-5 px-md-5">
        <form method="post" action="cek_login.php">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                <h2 class="fw-bold mb-5">LOGIN</h2>
                <form>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example3">Masukkan ID</label>
                        <input type="text" id="form3Example3" class="form-control" name="id_user"/>              
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                        <label class="form-label" for="form3Example4">Masukkan Password</label>
                        <input type="password" id="form3Example4" class="form-control" name="pass_user"/>
                    </div>

                

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4">
                    Masuk
                    </button>

                    <!-- Register buttons -->
                    
                </form>
                </div>
            </div>
        </form>
    </div>
        
  </div>
</section>
<!-- Section: Design Block -->
<!-- Section: Design Block -->
<!-- Section: Design Block -->
    
</body>
</html>