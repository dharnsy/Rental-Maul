<?php 
$koneksi = new mysqli("localhost", "root", "", "rental");

if (isset($_POST['submit'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $jk = $_POST['jk'];
    $telp = $_POST['telp'];
    $alamat = $_POST['alamat'];
    $user = $_POST['user'];
    $pass = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Check if NIK or username already exists
    $cekNik = mysqli_query($koneksi, "SELECT * FROM member WHERE nik='$nik' OR user='$user'");
    if (mysqli_num_rows($cekNik) > 0) {
        echo "<script>alert('NIK atau Username sudah digunakan!');window.location.href='register.php';</script>";
    } else {
        // Insert new member data
        $sql = "INSERT INTO member (nik, nama, jk, telp, alamat, user, pass) 
                VALUES ('$nik', '$nama', '$jk', '$telp', '$alamat', '$user', '$hashed_password')";
        $query = mysqli_query($koneksi, $sql);

        if ($query) {
            echo "<script>alert('Registrasi berhasil!');window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Gagal mendaftar.');window.location.href='register.php';</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>CarRental &mdash; Free Website Template by Colorlib</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="css/aos.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="css/style.css">
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index_peminjam.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    
        </div>
        <section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
  <div class="container-fluid">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">
            <h3 class="mb-5">Form Member</h3>

            <form action="" method="POST">
    <div class="mb-3"> 
        <label class="form-label" for="nik">NIK:</label>
        <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK Anda" required />
    </div>
    
    <div class="mb-3"> 
        <label class="form-label" for="nama">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Anda" required />
    </div>
    
    <div class="mb-3"> 
        <label class="form-label" for="jk">Jenis Kelamin:</label>
        <select class="form-control" id="jk" name="jk" required>
            <option value="L">Laki-Laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>
    
    <div class="mb-3"> 
        <label class="form-label" for="telp">No Telp:</label>
        <input type="text" class="form-control" id="telp" name="telp" placeholder="Masukkan No. Telepon Anda" required />
    </div>
    
    <div class="mb-3"> 
        <label class="form-label" for="alamat">Alamat:</label>
        <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Anda" required></textarea>
    </div>
    
    <div class="mb-3"> 
        <label class="form-label" for="user">Username:</label>
        <input type="text" class="form-control" id="user" name="user" placeholder="Masukkan Username Anda" required />
    </div>
    
    <div class="mb-3"> 
        <label class="form-label" for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Anda" required />
    </div>
    
    <button class="btn btn-primary" type="submit" name="submit">Daftar</button>
</form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="login.php">
                  <span>Sign in instead</span>
                </a>
              </p>
            </div>
          </div>
            

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
