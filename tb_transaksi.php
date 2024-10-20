<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "rental");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error); 
}

// Query untuk mengambil data transaksi dari tabel tbl_transaksi
$sql = "SELECT * FROM tb_transaksi";
$result = $koneksi->query($sql);

// Cek apakah query berhasil
if (!$result) {
    die("Query gagal: " . $koneksi->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>CarRental &mdash; Data Transaksi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
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
    h3.card-title {
      color: #FFD700;
    }
  </style>
</head>

<body>
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
            <a class="nav-link" href="konfirm.php">Konfirm</a>
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
              <h3 class="card-title"><strong>DATA TRANSAKSI</strong></h3>
            </div>
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">NIK</th>
                    <th scope="col">Nomor Polisi</th>
                    <th scope="col">Tanggal Booking</th>
                    <th scope="col">Tanggal Ambil</th>
                    <th scope="col">Tanggal Kembali</th>
                    <th scope="col">Supir</th>
                    <th scope="col">Total Harga</th>
                    <th scope="col">Down Payment</th>
                    <th scope="col">Kekurangan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                if ($result->num_rows > 0) {
                    $no = 1; // Untuk nomor urut
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nik']}</td>
                                <td>{$row['nopol']}</td>
                                <td>{$row['tgl_booking']}</td>
                                <td>{$row['tgl_ambil']}</td>
                                <td>{$row['tgl_kembali']}</td>
                                <td>" . ($row['supir'] ? 'Ya' : 'Tidak') . "</td>
                                <td>{$row['total']}</td>
                                <td>{$row['downpayment']}</td>
                                <td>{$row['kekurangan']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                  <a href='approve_booking.php?id={$row['id_transaksi']}' class='btn btn-primary btn-sm'>Approve</a>
                                </td>
                              </tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='12' class='text-center'>Tidak ada data transaksi</td></tr>";
                }
                ?>
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
