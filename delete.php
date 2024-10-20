<?php
$koneksi = new mysqli('localhost', 'root', '', 'rental');

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Pastikan nopol ada dalam parameter GET
if (isset($_GET['nopol'])) {
    $nopol = $koneksi->real_escape_string($_GET['nopol']); // Mencegah SQL injection

    // Siapkan query untuk delete
    $sql = "DELETE FROM tb_mobil WHERE nopol='$nopol'"; // Gunakan tanda kutip

    // Eksekusi query
    if ($koneksi->query($sql) === TRUE) {
        header("Location: tb_mobil.php");
        exit(); // Pastikan untuk keluar setelah header
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
} else {
    echo "Error: Nopol tidak ditemukan.";
}

// Tutup koneksi
$koneksi->close();
?>
