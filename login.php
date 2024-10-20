<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "rental");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Cek apakah kunci ada di array $_POST
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';

    // Cek tabel tbl_member
    $stmt = $koneksi->prepare("SELECT * FROM member WHERE user = ?");
    
    if ($stmt === false) {
        die("Error preparing statement: " . $koneksi->error);
    }

    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $member = $result->fetch_assoc();

    // Jika tidak ditemukan, cek tabel tbl_user
    if (!$member) {
        $stmt = $koneksi->prepare("SELECT * FROM user WHERE user = ?");
        
        if ($stmt === false) {
            die("Error preparing statement: " . $koneksi->error);
        }

        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    } else {
        $user = $member;
    }

    // Debugging: Tampilkan informasi login
    if ($user) {
      echo "Username ditemukan: " . $user['user'] . "<br>";
      
      // Debugging: Tampilkan password yang dimasukkan dan hash dari database
      echo "Password yang dimasukkan: " . $password . "<br>";
      echo "Hash password dari database: " . $user['pass'] . "<br>";
  } else {
      echo "Username tidak ditemukan.<br>";
  }
  
    // Verifikasi password
    if ($user && password_verify($password, $user['pass'])) {
        // Password benar, mulai sesi
        $_SESSION['user'] = $user['user'];

        if (isset($user['nik'])) {
            $_SESSION['nik'] = $user['nik'];
            $_SESSION['nama'] = $user['nama'];
        }

        if (isset($user['level'])) {
            if ($user['level'] === 'admin') {
                header("Location: admin_dashboard.php");
                exit;
            } elseif ($user['level'] === 'petugas') {
                header("Location: petugas.php");
                exit;
            }
        } else {
            header("Location: index_member.php?page=index_member.php");
            exit;
        }
    } else {
        echo "Invalid username or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
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
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background-color: #333333;">
    <div class="wrapper">
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

        <section class="vh-100" style="background-color: #333333;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card shadow-2-strong" style="border-radius: 1rem; background-color: #1c1c1c;">
                            <div class="card-body p-5 text-center">
                                <h3 class="mb-5" style="color: #FFD700;">Login</h3>
                                <form class="mb-3" action="" method="POST">
                                    <div class="mb-3">
                                        <label for="username" class="form-label" style="color: #FFD700;">User</label>
                                        <input type="text" name="user" class="form-control" id="username" placeholder="Enter your username" required autofocus />
                                    </div>
                                    <div class="mb-3 form-password-toggle">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="password" style="color: #FFD700;">Password</label>
                                            <a href="#"><small style="color: #FFD700;">Forgot Password?</small></a>
                                        </div>
                                        <div class="input-group input-group-merge">
                                            <input type="password" name="pass" id="password" class="form-control" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" required />
                                        </div>
                                    </div>
                                    <button name="submit" class="btn" style="background-color: #FFD700; border-color: #FFD700; color: black;" type="submit">Sign in</button>
                                </form>

                                <p class="text-center" style="color: #FFD700;">
                                    <span>New on our platform?</span>
                                    <a href="registrasi.php" style="color: #FFD700;"><span>Create an account</span></a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="main-footer" style="background-color: #333333; color: #FFD700;"></footer>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="dist/js/adminlte.js"></script>
</body>
</html>
