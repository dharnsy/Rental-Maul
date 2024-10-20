<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "rental");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Ambil nomor polisi dari URL
$nopol = isset($_GET['nopol']) ? $_GET['nopol'] : '';
$total = 0; // Default harga

// Ambil harga mobil dari database
if (!empty($nopol)) {
    $sql_harga = "SELECT harga FROM tb_mobil WHERE nopol = '$nopol'";
    $result_harga = $koneksi->query($sql_harga);

    if ($result_harga->num_rows > 0) {
        $row_harga = $result_harga->fetch_assoc();
        $total = $row_harga['harga'];
    }
}

// Ambil NIK dari tabel member berdasarkan username di session
session_start();
$user = isset($_SESSION['user']) ? $_SESSION['user'] : ''; // Ambil 'user' dari session login

// Query untuk mengambil NIK berdasarkan username
$nik = '';
if (!empty($user)) {
    $sql_nik = "SELECT nik FROM member WHERE user = '$user'";
    $result_nik = $koneksi->query($sql_nik);

    if ($result_nik->num_rows > 0) {
        $row_nik = $result_nik->fetch_assoc();
        $nik = $row_nik['nik'];
    }
}

// Cek apakah form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nik = $_POST['nik'];
    $nopol = $_POST['nopol'];
    $tgl_booking = $_POST['tgl_booking'];
    $tgl_ambil = $_POST['tgl_ambil'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $supir = isset($_POST['supir']) ? 1 : 0;
    $total = $_POST['harga']; // Perbaiki untuk menggunakan 'harga'
    $downpayment = $_POST['downpayment'];
    $kekurangan = $_POST['kekurangan'];
    $status = 'booking';

    // Query untuk menyimpan data transaksi
    $sql_transaksi = "INSERT INTO tb_transaksi (nik, nopol, tgl_booking, tgl_ambil, tgl_kembali, supir, total, downpayment, kekurangan, status)
                      VALUES ('$nik', '$nopol', '$tgl_booking', '$tgl_ambil', '$tgl_kembali', '$supir', '$total', '$downpayment', '$kekurangan', '$status')";

    if ($koneksi->query($sql_transaksi) === TRUE) {
        // Redirect ke halaman sukses
        header("Location: tb_transaksi.php?pesan=sukses");
        exit();
    } else {
        echo "Error: " . $sql_transaksi . "<br>" . $koneksi->error;
    }
}
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
    <link rel="stylesheet" href="css/style.css">
    <style>
         body {
            background-color: #212529;
            font-family: 'Roboto', sans-serif;
            color: white;
        }
        .card {
            background-color: #343a40;
        }
        .btn-primary {
            background-color: #FFC107;
            border-color: #FFC107;
        }
        .navbar {
            background-color: #FFC107;
        }
        .navbar .nav-link, .navbar .navbar-brand {
            color: #212529 !important;
        }
        .card-header {
            background-color: #FFC107;
        }
        .card-header h3 {
            color: #212529 !important;
        }
        .card {
            background-color: #343a40;
            color: white;
        }
        .form-control {
            background-color: #495057;
            color: black;
            border-color: #FFC107;
        }
        .form-control:focus {
            border-color: #e0a800;
            box-shadow: none;
        }
        .form-label {
            color: #FFC107;
        }
        .btn-primary {
            background-color: #FFC107;
            border-color: #FFC107;
            color: #212529;
        }
        .btn-primary:hover {
            background-color: #e0a800;
            border-color: #d39e00;
        }
        .form-check-label {
            color: #ffffff;
        }
    </style>
</head>
<body>
<div class="wrapper">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light">
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
                      <a class="nav-link" href="tb_sewa.php">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="kekurangan.php">Kekurangan</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="riwayat.php">Riwayat</a>
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
                  <div class="card card">
                      <div class="card-header">
                          <h3 class="card-title"><strong>Data Mobil</strong></h3>
                      </div>
                      <div class="card-body">
                          <form action="form_transaksi.php" method="POST">
                              <div class="form-group">
                                  <label for="nik">NIK</label>
                                  <input type="text" class="form-control" id="nik" name="nik" value="<?php echo htmlspecialchars($nik); ?>" required>
                              </div>
                              <div class="form-group">
                                  <label for="nopol">Nomor Polisi</label>
                                  <input type="text" class="form-control" id="nopol" name="nopol" value="<?php echo htmlspecialchars($nopol); ?>" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="tgl_booking">Tanggal Booking</label>
                                  <input type="date" class="form-control" id="tgl_booking" name="tgl_booking" required>
                              </div>
                              <div class="form-group">
                                  <label for="tgl_ambil">Tanggal Ambil</label>
                                  <input type="date" class="form-control" id="tgl_ambil" name="tgl_ambil" required>
                              </div>
                              <div class="form-group">
                                  <label for="tgl_kembali">Tanggal Kembali</label>
                                  <input type="date" class="form-control" id="tgl_kembali" name="tgl_kembali" required>
                              </div>
                              <div class="form-group">
                                  <label for="supir">Pilih Supir</label>
                                  <input type="checkbox" id="supir" name="supir">
                                  <label for="supir">Ya</label>
                              </div>
                              <div class="form-group">
                                  <label for="total">Total Harga</label>
                                  <input type="text" class="form-control" id="total" name="harga" value="<?php echo htmlspecialchars($total); ?>" readonly>
                              </div>
                              <div class="form-group">
                                  <label for="downpayment">Down Payment</label>
                                  <input type="text" class="form-control" id="downpayment" name="downpayment" required>
                              </div>
                              <div class="form-group">
                                  <label for="kekurangan">Kekurangan</label>
                                  <input type="text" class="form-control" id="kekurangan" name="kekurangan" required readonly>
                              </div>
                              <button type="submit" class="btn btn-primary">Sewa</button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    // Mengisi tanggal booking dengan real-time
    function setRealTimeBookingDate() {
        const today = new Date();
        const yyyy = today.getFullYear();
        const mm = String(today.getMonth() + 1).padStart(2, '0');
        const dd = String(today.getDate()).padStart(2, '0');
        const todayDate = yyyy + '-' + mm + '-' + dd;
        document.getElementById("tgl_booking").value = todayDate;
    }

    setRealTimeBookingDate();

    // Fungsi untuk menghitung total harga berdasarkan pilihan sopir
    function calculateTotalHarga() {
        const harga = parseFloat($('#total').val()) || 0;  
        const supir = $('#supir').is(':checked') ? 100000 : 0;  
        const total = harga + supir;  
        $('#total').val(total.toFixed(2));  
        calculateKekurangan();  
    }

    // Fungsi untuk menghitung kekurangan pembayaran
    function calculateKekurangan() {
        const total = parseFloat($('#total').val()) || 0;
        const downpayment = parseFloat($('#downpayment').val()) || 0;
        const kekurangan = total - downpayment;
        $('#kekurangan').val(kekurangan >= 0 ? kekurangan.toFixed(2) : 0);  // Jika kekurangan negatif, set ke 0
    }

    // Event listener saat halaman siap
    $(document).ready(function() {
        // Event listener saat checkbox sopir dicentang atau tidak
        $('#supir').change(function() {
            calculateTotalHarga();  // Panggil fungsi hitung total harga saat status sopir berubah
        });

        // Event listener saat nilai downpayment berubah
        $('#downpayment').on('input', function() {
            calculateKekurangan();  // Panggil fungsi hitung kekurangan saat downpayment diubah
        });
    });
</script>

</body>
</html>
