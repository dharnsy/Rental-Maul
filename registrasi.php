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
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background-color: #333333;">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark" style="background-color: #FFD700;">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index_peminjam.php" class="nav-link" style="color: black;">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link" style="color: black;">Contact</a>
      </li>
    </ul>
  </nav>

  <!-- Main content -->
  <section class="vh-100" style="background-color: #333333;">
    <div class="container py-5 h-100">
        <div class="container-fluid">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                    <div class="card shadow-2-strong" style="border-radius: 1rem; background-color: #1c1c1c;">
                        <div class="card-body p-5">
                            <h3 class="mb-5 text-center" style="color: #FFD700;"><b>Registrasi</b></h3>
                            <form action="" method="POST">
                                
                                <!-- NIK (Label di samping input) -->
                                <div class="row mb-3 align-items-center">
                                    <div class="col-sm-3 text-end">
                                        <label class="form-label" for="nik" style="color: #FFD700;">NIK:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK Anda" required />
                                    </div>
                                </div>
                                
                                <!-- Nama -->
                                <div class="row mb-3 align-items-center">
                                    <div class="col-sm-3 text-end">
                                        <label class="form-label" for="nama" style="color: #FFD700;">Nama:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Anda" required />
                                    </div>
                                </div>
                                
                                <!-- Jenis Kelamin -->
                                <div class="row mb-3 align-items-center">
                                    <div class="col-sm-3 text-end">
                                        <label class="form-label" for="jk" style="color: #FFD700;">Jenis Kelamin:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="form-control" id="jk" name="jk" required>
                                            <option value="L">Laki-Laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <!-- No Telp -->
                                <div class="row mb-3 align-items-center">
                                    <div class="col-sm-3 text-end">
                                        <label class="form-label" for="telp" style="color: #FFD700;">No Telp:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="telp" name="telp" placeholder="Masukkan No. Telepon Anda" required />
                                    </div>
                                </div>
                                
                                <!-- Alamat -->
                                <div class="row mb-3 align-items-center">
                                    <div class="col-sm-3 text-end">
                                        <label class="form-label" for="alamat" style="color: #FFD700;">Alamat:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat Anda" required></textarea>
                                    </div>
                                </div>
                                
                                <!-- Username -->
                                <div class="row mb-3 align-items-center">
                                    <div class="col-sm-3 text-end">
                                        <label class="form-label" for="user" style="color: #FFD700;">Username:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="user" name="user" placeholder="Masukkan Username Anda" required />
                                    </div>
                                </div>
                                
                                <!-- Password -->
                                <div class="row mb-3 align-items-center">
                                    <div class="col-sm-3 text-end">
                                        <label class="form-label" for="password" style="color: #FFD700;">Password:</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Anda" required />
                                    </div>
                                </div>
                                
                                <!-- Tombol Daftar -->
                                <button class="btn" type="submit" name="submit" style="background-color: #FFD700; border-color: #FFD700; color: black;">
                                    Daftar
                                </button>
                            </form>

                            <!-- Link Sign In -->
                            <p class="text-center mt-3" style="color: #FFD700;">
                                <span>Sudah punya akun?</span>
                                <a href="login.php" style="color: #FFD700;">
                                    <span>Sign in instead</span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>

<!-- Scripts -->
<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
