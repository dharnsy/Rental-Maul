<!DOCTYPE html>
<html lang="en">
<head>
    <title>CarRental &mdash; Member Dashboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #212529; /* Warna hitam untuk background */
        }

        .navbar {
            background-color: #FFC107; /* Warna kuning untuk navbar */
        }

        .navbar .nav-link, .navbar .navbar-brand {
            color: #212529 !important; /* Warna hitam untuk teks navbar */
        }

        .card {
            background-color: #343a40; /* Warna gelap untuk kartu */
            color: white; /* Warna putih untuk teks dalam kartu */
        }

        .card h1 {
            color: #FFC107; /* Warna kuning untuk judul dashboard */
        }

        .card a {
            background-color: #FFC107;
            color: #212529;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .card a:hover {
            background-color: #e0a800;
            color: white;
        }

        section {
            background-color: #212529; /* Warna hitam untuk background section */
            color: white; /* Warna putih untuk teks */
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
  
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index_member.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="logout.php" class="nav-link">Logout</a>
      </li> 
      <li class="nav-item d-none d-sm-inline-block">
        <a href="contact.php" class="nav-link">Contact</a>
      </li>
    </ul>
  </nav>
  
  <!-- Section Dashboard -->
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-12 col-lg-6 col-xl-5">
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
            <div class="card-body p-5 text-center">

              <h1>DASBOARD MEMBER</h1>
              <p>Selamat datang di dashboard Anda!</p>
              <p>Pilih opsi di bawah ini:</p>
              <a href="tb_sewa.php">Lihat Mobil Tersedia</a><br><br>
              <a href="sewa_mobil.php">Pesan Mobil</a><br><br>
              <a href="riwayat_sewa.php">Riwayat Sewa</a>

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
  
</div>
<!-- ./wrapper -->

<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
