<?php
include "conn.php";

// Mengecek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Memeriksa apakah data $_POST['id'] tersedia
if (isset($_POST['id'])) {
    $id = $_POST['id'];
} else {
    die("Kode tidak ditemukan dalam data yang dikirimkan.");
}

$tanggal_awal = $_POST['tanggal_awal'];
$tanggal_akhir = $_POST['tanggal_akhir'];
$jenis_cuti = $_POST['jenis_cuti'];
$ket = $_POST['ket'];
$status = $_POST['status'];
$tanggal_masuk = $_POST['tanggal_masuk'];

// Menghitung jumlah hari cuti dari tanggal_awal hingga tanggal_masuk
$hari_cuti = date_diff(date_create($tanggal_awal), date_create($tanggal_masuk))->format('%a');

// Membuat query untuk update data
$sql = "UPDATE cuti SET 
            tanggal_awal = '$tanggal_awal', 
            tanggal_akhir = '$tanggal_akhir', 
            jumlah = '$hari_cuti', 
            jenis_cuti = '$jenis_cuti', 
            ket = '$ket', 
            status = '$status', 
            tanggal_masuk = '$tanggal_masuk' 
        WHERE kode = '$id'";

// Mengeksekusi query update
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Data berhasil diperbarui'); window.location.href = 'tabel-cuti.php';</script>";

    // Tidak ada query trigger di sini karena trigger diaktifkan secara otomatis oleh database setelah update

} else {
    echo "Error: " . $stmt->error;
}

// Menutup koneksi
$conn->close();
?>