<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "rental");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Cek apakah form telah di-submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form dengan pengecekan apakah variabel POST ada
    $nik = isset($_POST['nik']) ? $_POST['nik'] : '';
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $jk = isset($_POST['jk']) ? $_POST['jk'] : '';
    $telp = isset($_POST['telp']) ? $_POST['telp'] : '';
    $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
    $user = isset($_POST['user']) ? $_POST['user'] : '';
    $pass = isset($_POST['pass']) ? $_POST['pass'] : '';

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO member (nik, nama, jk, telp, alamat, user, pass) 
            VALUES ('$nik', '$nama', '$jk', '$telp', '$alamat', '$user', '$pass')";

    if ($koneksi->query($sql) === TRUE) {
        // Jika berhasil, kembali ke halaman utama dengan pesan sukses
        header("Location: tb_member.php?pesan=sukses");
        exit();
    } else {
        // Jika gagal, kembali ke halaman utama dengan pesan error
        header("Location: tb_member.php?pesan=gagal");
        exit();
    }
}

// Tutup koneksi
$koneksi->close();
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
        .modal-content {
            background-color: #1c1c1c;
            color: #FFD700;
            border: 1px solid #FFD700;
        }
        .modal-header {
            border-bottom: 1px solid #FFD700;
        }
        .modal-title {
            color: #FFD700;
        }
        .modal-footer {
            border-top: 1px solid #FFD700;
        }
        .btn-secondary {
            background-color: #333333;
            border-color: #FFD700;
            color: #FFD700;
        }
        .btn-secondary:hover {
            background-color: #444444;
            border-color: #E5BE00;
        }
        .close {
            color: #FFD700;
            opacity: 1;
        }
        .close:hover {
            color: #E5BE00;
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
    <?php
    // Koneksi ke database
    $koneksi = new mysqli("localhost", "root", "", "rental");

    // Cek koneksi
    if ($koneksi->connect_error) {
        die("Koneksi gagal: " . $koneksi->connect_error);
    }

    // Query untuk mengambil data dari tbl_member
    $sql = "SELECT * FROM member";
    $result = $koneksi->query($sql);
    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><strong>LIST MEMBER</strong></h3>
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addMemberModal">
                                Tambah Member
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nik</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Telp</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Password</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
<?php if ($result->num_rows > 0): ?>
    <?php $no = 1; ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <th scope="row"><?php echo $no++; ?></th>
            <td><?php echo htmlspecialchars($row['nik']); ?></td>
            <td><?php echo htmlspecialchars($row['nama']); ?></td>
            <td><?php echo htmlspecialchars($row['jk']); ?></td>
            <td><?php echo htmlspecialchars($row['telp']); ?></td>
            <td><?php echo htmlspecialchars($row['alamat']); ?></td>
            <td><?php echo htmlspecialchars($row['user']); ?></td>
            <td><?php echo htmlspecialchars($row['pass']); ?></td>
            <td>
                <!-- Tambahkan tombol hapus -->
                <a href="hapus.php?id=<?php echo $row['nik']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus member ini?')">Hapus</a>
            </td>
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr>
        <td colspan="9" class="text-center">Tidak ada data Member.</td>
    </tr>
<?php endif; ?>
</tbody>

<!-- Modal untuk Tambah Member -->
<div class="modal fade" id="addMemberModal" tabindex="-1" role="dialog" aria-labelledby="addMemberModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMemberModalLabel">Tambah Member</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="tb_member.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input type="text" class="form-control" id="nik" name="nik" required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label for="jk">Jenis Kelamin</label>
                        <select class="form-control" id="jk" name="jk" required>
                            <option value="">Pilih</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="telp">Telepon</label>
                        <input type="text" class="form-control" id="telp" name="telp" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="user">Username</label>
                        <input type="text" class="form-control" id="user" name="user" required>
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" id="pass" name="pass" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
            
        </div>
    </div>
</div>


<!-- jQuery -->
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
// Tutup koneksi
$koneksi->close();
?>
