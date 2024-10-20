<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "rental");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Cek apakah ada nopol yang dikirim melalui URL
if (isset($_GET['nopol'])) {
    $nopol = $_GET['nopol'];
    // Ambil data mobil berdasarkan nopol
    $sql = "SELECT * FROM tb_mobil WHERE nopol='$nopol'";
    $result = $koneksi->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<script>alert('Data tidak ditemukan.'); window.location.href='tb_mobil.php';</script>";
        exit; // Keluar jika data tidak ditemukan
    }
}

// Proses update data jika form disubmit
if (isset($_POST['nopol'])) {
    $nopol = $_POST['nopol'];
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $tahun = $_POST['tahun'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];

    // Siapkan query untuk update
    if ($_FILES['foto']['name'] != '') {
        // Proses upload file jika ada foto baru
        $foto = $_FILES['foto']['name'];
        $file_tmp = $_FILES['foto']['tmp_name'];

        // Move file ke direktori img
        if (move_uploaded_file($file_tmp, 'img/' . $foto)) {
            $sql = "UPDATE tb_mobil SET brand='$brand', type='$type', tahun='$tahun', harga='$harga', status='$status', foto='$foto' WHERE nopol='$nopol'";
        } else {
            echo "<script>alert('Gagal mengupload foto.'); window.history.back();</script>";
            exit; // Keluar jika gagal upload
        }
    } else {
        // Jika tidak ada foto baru, tidak perlu update kolom foto
        $sql = "UPDATE tb_mobil SET brand='$brand', type='$type', tahun='$tahun', harga='$harga', status='$status' WHERE nopol='$nopol'";
    }

    // Eksekusi query
    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diupdate!'); window.location.href='tb_mobil.php';</script>";
    } else {
        echo "<script>alert('Error: " . $koneksi->error . "'); window.history.back();</script>";
    }
}

// Tutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>CarRental &mdash; Form</title>
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
  <link rel="stylesheet" href="css/style.css">

  <!-- Custom Style -->
  <style>
    body {
      background-color: #333333; /* Hitam */
    }
    .navbar {
      background-color: #FFD700; /* Kuning */
    }
    .navbar .nav-link, .navbar .navbar-brand {
      color: black;
    }
    .card {
      background-color: #1c1c1c; /* Gelap */
      color: #FFD700; /* Kuning */
    }
    .btn-primary {
      background-color: #FFD700;
      border-color: #FFD700;
      color: black;
    }
    .btn-primary:hover {
      background-color: #E5BE00;
      border-color: #E5BE00;
    }
    label {
      color: #FFD700;
    }
    h3.card-title {
      color: #FFD700;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">
        <i class="fas fa-home"></i> MobilioRent
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="tb_mobil.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="form.php">Pendataan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tinjau.php">Laporan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <br>
  
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><strong>Data Mobil</strong></h3>
            </div>
            <div class="card-body">
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-nopol">Nopol</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-nopol" name="nopol" placeholder="Nomor Polisi" value="<?php echo isset($row['nopol']) ? $row['nopol'] : ''; ?>" required />
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-brand">Brand</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-brand" name="brand" placeholder="Merek Mobil" value="<?php echo isset($row['brand']) ? $row['brand'] : ''; ?>" required />
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-type">Type</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-type" name="type" placeholder="Tipe Mobil" value="<?php echo isset($row['type']) ? $row['type'] : ''; ?>" required />
                  </div>
                </div>

                <div class="row mb-3">
    <label class="col-sm-2 col-form-label" for="basic-default-tahun">Tahun</label>
    <div class="col-sm-10">
        <input type="number" class="form-control" id="basic-default-tahun" name="tahun" min="1900" max="2100" required />
    </div>
</div>


                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-harga">Harga</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-harga" name="harga" placeholder="Harga Sewa per Hari" value="<?php echo isset($row['harga']) ? $row['harga'] : ''; ?>" required />
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="formFileDisabled">Foto</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="foto" id="formFileDisabled" />
                    <!-- Menampilkan foto saat ini -->
                    <?php if (isset($row['foto']) && $row['foto'] != ''): ?>
                      <img src="img/<?php echo $row['foto']; ?>" alt="Current Photo" width="100" />
                    <?php endif; ?>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" name="status" for="basic-default-status">Status</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="basic-default-status" name="status" required>
                      <option value="tersedia" <?php echo (isset($row['status']) && $row['status'] == 'tersedia') ? 'selected' : ''; ?>>Tersedia</option>
                      <option value="tidak" <?php echo (isset($row['status']) && $row['status'] == 'tidak') ? 'selected' : ''; ?>>Tidak</option>
                    </select>
                  </div>
                </div>

                <div class="row justify-content-end">
                  <div class="col-sm-10">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark"></aside>
</div>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
</body>
</html>
