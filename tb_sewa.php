<?php
$koneksi = new mysqli("localhost", "root", "", "rental");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data dari tbl_mobil
$sql = "SELECT nopol, brand, type, tahun, harga, status, foto FROM tb_mobil";
$result = $koneksi->query($sql);

// Cek apakah query berhasil
if (!$result) {
    die("Query error: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>CarRental &mdash; TB Mobil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    
    <style>
        body {
            background-color: #212529; /* Warna hitam untuk background */
            font-family: 'Roboto', sans-serif;
        }
        .navbar {
            background-color: #FFC107; /* Warna kuning untuk navbar */
        }
        .navbar .nav-link, .navbar .navbar-brand {
            color: #212529 !important; /* Warna hitam untuk teks navbar */
        }
        .card {
            background-color: #343a40; /* Warna hitam untuk kartu */
            color: white; /* Warna putih untuk teks dalam kartu */
        }
        .card-title {
            color: #FFC107; /* Warna kuning untuk judul kartu */
        }
        .btn-primary {
            background-color: #FFC107;
            border-color: #FFC107;
            color: #212529; /* Warna hitam untuk teks tombol */
        }
        .btn-primary:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
    </style>
</head>
<body>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand" href="#">
        <i class="fas fa-home"></i> MobilioRent 
      </a>

      <!-- Toggler/collapsible Button for small screens -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Links -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="table_mobil.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="form_mobil.php">Pendataan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tinjau_mobil.php">Laporan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</div>
<br>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="row">
                <?php
                // Menampilkan data jika ada hasil
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="img/<?php echo $row['foto']; ?>" class="card-img-top" alt="foto">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['brand'] . " " . $row['type']; ?></h5>
                                    <p class="card-text">
                                        <strong>Nomor Polisi:</strong> <?php echo $row['nopol']; ?><br>
                                        <strong>Tahun:</strong> <?php echo date('Y', strtotime($row['tahun'])); ?><br>
                                        <strong>Harga/Hari:</strong> Rp <?php echo number_format($row['harga'], 2, ',', '.'); ?><br>
                                        <strong>Status:</strong> <?php echo ucfirst($row['status']); ?>
                                    </p>
                                </div>
                                <div class="card-footer text-center">
                                    <?php if ($row['status'] == 'tersedia') { ?>
                                        <a href="form_transaksi.php?nopol=<?php echo $row['nopol']; ?>" class="btn btn-primary">Sewa</a>
                                    <?php } else { ?>
                                        <button class="btn btn-secondary" disabled>Tidak Tersedia</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='text-center'>Tidak ada data mobil tersedia.</p>";
                }
                ?>
                </div>
            </div>
        </div> 
    </div>
</section>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>

<?php
// Tutup koneksi
$koneksi->close();
?>
