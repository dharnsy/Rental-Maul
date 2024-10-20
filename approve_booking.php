<?php
// Aktifkan error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "rental");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error); 
}

// Ambil ID transaksi dari parameter URL
$id_transaksi = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Debug: Tampilkan ID transaksi
echo "ID Transaksi: " . $id_transaksi . "<br>";

// Query untuk mengupdate status menjadi 'approve'
$sql = "UPDATE tb_transaksi SET status='approve' WHERE id_transaksi=?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id_transaksi);

// Eksekusi query dan cek hasilnya
if ($stmt->execute()) {
    echo "Status berhasil diubah.<br>";
    // Jika berhasil, redirect kembali ke halaman data transaksi
    header("Location: tb_transaksi.php");
    exit();
} else {
    echo "Error updating record: " . $stmt->error;
}

// Tutup statement dan koneksi
$stmt->close();
$koneksi->close();
?>
