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
            <a class="nav-link" href="tb_mobil.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="form.php">Pendataan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="tb_transaksi.php">Konfirmasi</a>
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
                    <input type="text" class="form-control" id="basic-default-nopol" name="nopol" placeholder="Nomor Polisi" required />
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-brand">Brand</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-brand" name="brand" placeholder="Merek Mobil" required />
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="basic-default-type">Type</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="basic-default-type" name="type" placeholder="Tipe Mobil" required />
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
                    <input type="text" class="form-control" id="basic-default-harga" name="harga" placeholder="Harga Sewa per Hari" required />
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="formFileDisabled">Foto</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="foto" id="formFileDisabled" required />
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" name="status" for="basic-default-status">Status</label>
                  <div class="col-sm-10">
                    <select class="form-control" id="basic-default-status" name="status" required>
                      <option value="tersedia">Tersedia</option>
                      <option value="tidak">Tidak</option>
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

          <!-- PHP Logic -->
          <?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "rental");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Cek apakah form disubmit
if (isset($_POST['submit'])) {
    $nopol = $_POST['nopol'];
    $brand = $_POST['brand'];
    $type = $_POST['type'];
    $tahun = $_POST['tahun'];
    $harga = $_POST['harga'];
    $status = $_POST['status'];

    // Validasi file foto
    $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
    $foto = $_FILES['foto']['name'];
    $x = explode('.', $foto);
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['foto']['size'];
    $file_tmp = $_FILES['foto']['tmp_name'];

    // Cek apakah ekstensi file diperbolehkan
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        // Cek ukuran file (maksimum 1 MB)
        if ($ukuran < 1044070) {
            // Membuat direktori img jika belum ada
            if (!file_exists('img')) {
                mkdir('img', 0777, true);
            }

            // Pindahkan file ke folder img
            if (move_uploaded_file($file_tmp, 'img/' . $foto)) {
                // Insert data ke database
                $sql = "INSERT INTO tb_mobil (nopol, brand, type, tahun, harga, status, foto) 
                        VALUES ('$nopol', '$brand', '$type', '$tahun', '$harga', '$status', '$foto')";

                // Eksekusi query
                if ($koneksi->query($sql) === TRUE) {
                    echo "<script>
                        alert('Data mobil berhasil diinput!');
                        window.location.href = 'tb_mobil.php'; // Redirect setelah berhasil input
                    </script>";
                } else {
                    echo "Gagal menyimpan data: " . $koneksi->error;
                }
            } else {
                echo "Gagal upload gambar!";
            }
        } else {
            echo "Ukuran file terlalu besar, maksimal 1 MB!";
        }
    } else {
        echo "Ekstensi file tidak diperbolehkan!";
    }
}

// Tutup koneksi
$koneksi->close();
?>

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
