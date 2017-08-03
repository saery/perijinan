<?php

  // ambil pesan jika ada  
  if (isset($_GET["pesan"])) {
      $pesan = $_GET["pesan"];
  }
  
  // cek apakah form telah di submit
  if (isset($_POST["submit"])) {
    // form telah disubmit, proses data
   
    // ambil nilai form 
    $username = htmlentities(strip_tags(trim($_POST["username"])));
    $password = htmlentities(strip_tags(trim($_POST["password"])));

    // siapkan variabel untuk menampung pesan error
    $pesan_error="";
    
    // cek apakah "username" sudah diisi atau tidak
    if (empty($username)) {
      $pesan_error .= "Username belum diisi <br>";
    }
    
    // cek apakah "password" sudah diisi atau tidak
    if (empty($password)) {
      $pesan_error .= "Password belum diisi <br>";
    }
    
    // buat koneksi ke mysql dari file connection.php
    include("config/+koneksi.php");
    
    // filter dengan mysqli_real_escape_string
    $username = mysqli_real_escape_string($link,$username);
    $password = mysqli_real_escape_string($link,$password);
    // generate hashing 
    $password_sha1 = sha1($password);
    
    // cek apakah username dan password ada di tabel admin
    $query = "SELECT * FROM admin WHERE username = '$username' 
              AND password = '$password_sha1'";
    $result = mysqli_query($link,$query);
    
    if(mysqli_num_rows($result) == 0 )  { 
      // data tidak ditemukan, buat pesan error
      $pesan_error .= "Username dan / atau Password tidak sesuai";
    }
    
      // bebaskan memory 
      mysqli_free_result($result);
    
      // tutup koneksi dengan database MySQL
      mysqli_close($link);

    // jika lolos validasi, set session 
    if ($pesan_error === "") {
      session_start();
      $_SESSION["nama"] = $username;
      header("Location: index.php");
    }
  }
  else {
    // form belum disubmit atau halaman ini tampil untuk pertama kali 
    // berikan nilai awal untuk semua isian form
    $pesan_error = "";
    $username = "";
    $password = "";
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>DPM-PTSP KUTAI BARAT</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="assets/login/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="assets/login/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <style>
  	.error {
      background-color: #FFECEC;
      padding: 10px 15px;
      margin: 0 0 20px 0;
      border: 1px solid red;
      box-shadow: 1px 0px 3px red ;
    }
  </style>
  <body class="login-bg">
	<div class="page-content container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="login-wrapper">
			        <div class="box">
			            <div class="content-wrap">
			                <h6>DPM-PTSP KUTAI BARAT</h6>

			                <?php
  								// tampilkan pesan jika ada
  							if (isset($pesan)) {
      							echo "<div class=\"pesan\">$pesan</div>";
  							}

  								// tampilkan error jika ada
  							if ($pesan_error !== "") {
      							echo "<div class=\"error\">$pesan_error</div>";
  							}
							?>
	<form action="login.php" method="post">
			<!-- Form User -->
    		<input type="text" class="form-control" name="username" id="username" value="<?php echo $username ?>" placeholder="Username">
		 	<!-- Form Password -->
 			<input type="password" class="form-control" name="password" id="password" value="<?php echo $username ?>" placeholder="Password">
			    <div class="action">
			        <input type="submit" class="btn btn-primary signup" name="submit" value="Log In">
			    </div>
	</form>                
			            </div>
			        </div>

			        
			    </div>
			</div>
		</div>
	</div>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/login/bootstrap.min.js"></script>
    <script src="assets/login/custom.js"></script>
  </body>
</html>