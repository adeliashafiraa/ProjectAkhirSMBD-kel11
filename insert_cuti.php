<?php
// Membuat koneksi
include "conn.php";

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $kode = $_POST['kode'] ?? null;
    $nik = $_POST['nik'] ?? null;
    $tanggal_awal = $_POST['tanggal_awal'] ?? null;
    $tanggal_akhir = $_POST['tanggal_akhir'] ?? null;
    $jumlah_cuti = $_POST['jumlah'] ?? null;
    $jenis_cuti = $_POST['jenis_cuti'] ?? null;
    $ket = $_POST['ket'] ?? null;
    $tanggal_masuk = $_POST['tanggal_masuk'] ?? null;
    $status = $_POST['status'] ?? null;

    // Validasi data
    if ($kode && $nik && $tanggal_awal && $tanggal_akhir && $jumlah_cuti && $jenis_cuti && $tanggal_masuk && $status) {
        // Memanggil stored procedure
        $sql = "CALL buat_cuti(?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        // Pastikan jumlah parameter sesuai dengan placeholder
        $stmt->bind_param("sssssssss", $kode, $nik, $tanggal_awal, $tanggal_akhir, $jumlah_cuti, $jenis_cuti, $ket, $status, $tanggal_masuk);

        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil dihapus.'); window.location.href = 'tabel-cuti.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Menutup statement
        $stmt->close();
    } else {
        echo "Semua data harus diisi.";
    }
}

// Menutup koneksi
$conn->close();
?>