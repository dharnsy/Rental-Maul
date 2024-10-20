<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "rental");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Query untuk mengambil data mobil dari tabel tbl_mobil
$sql = "SELECT * FROM tb_mobil";
$result = $koneksi->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>CarRental &mdash; TB Mobil</title>
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

  <style>
    body {
      background-color: #333333;
      font-family: 'Roboto', sans-serif;
    }
    .navbar {
      background-color: #FFD700;
    }
    .navbar .nav-link, .navbar .navbar-brand {
      color: black;
    }
    .card {
      background-color: #1c1c1c;
      color: #FFD700;
    }
    .table-bordered {
      background-color: #1c1c1c;
      color: #FFD700;
      border-color: #FFD700;
    }
    .table-bordered th, .table-bordered td {
      border: 1px solid #FFD700;
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
    .pagination .page-link {
      background-color: #FFD700;
      color: black;
    }
    .pagination .page-item.active .page-link {
      background-color: #E5BE00;
      border-color: #E5BE00;
      color: black;
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
            <a class="nav-link" href="tb_transaksi.php">Konfirm</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Log Out</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Content Section -->
  <br>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title"><strong>LIST MOBIL</strong></h3>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nopol</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Type</th>
                    <th scope="col">Tahun</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <tbody>
  <?php
  if ($result->num_rows > 0) {
      $no = 1;
      while ($row = $result->fetch_assoc()) {
          echo "<tr>";
          echo "<td>" . $no++ . "</td>";
          echo "<td>" . $row['nopol'] . "</td>";
          echo "<td>" . $row['brand'] . "</td>";
          echo "<td>" . $row['type'] . "</td>";
          echo "<td>" . $row['tahun'] . "</td>";
          echo "<td><img src='img/" . $row['foto'] . "' alt='" . $row['brand'] . "' width='100'></td>";
          echo "<td>" . ucfirst($row['status']) . "</td>";
          echo "<td>
            <a href='edit.php?nopol=" . $row['nopol'] . "'>
                <button class='btn btn-warning btn-sm'>Edit</button>
            </a>
            <a href='delete.php?nopol=" . $row['nopol'] . "' onclick='return confirm(\"Hapus mobil dengan Nopol " . $row['nopol'] . "?\")'>
                <button class='btn btn-danger btn-sm'>Delete</button>
            </a>
        </td>";
        echo "</tr>";;
      }
  } else {
      echo "<tr><td colspan='8' class='text-center'>Data tidak ditemukan</td></tr>";
  }
  ?>
  <!-- Button trigger modal -->



</tbody>

             
              </table>
            </div>
            <div class="card-footer clearfix">
              <ul class="pagination pagination-sm m-0 float-right">
                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

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
