<?php
// Koneksi ke database
$koneksi = new mysqli("localhost", "root", "", "rental");

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Cek apakah parameter ID dikirim
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus member berdasarkan NIK
    $sql = "DELETE FROM member WHERE nik = '$id'";

    if ($koneksi->query($sql) === TRUE) {
        // Jika berhasil, kembali ke halaman tb_member.php dengan pesan sukses
        header("Location: tb_member.php?pesan=hapus_sukses");
    } else {
        // Jika gagal, kembali ke halaman tb_member.php dengan pesan error
        header("Location: tb_member.php?pesan=hapus_gagal");
    }
} else {
    // Jika tidak ada ID yang dikirim, kembali ke halaman tb_member.php
    header("Location: tb_member.php");
}

// Tutup koneksi
$koneksi->close();
?>
