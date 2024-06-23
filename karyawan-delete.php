<?php
include "conn.php";

if (isset($_GET['id'])) {
    $nik = $_GET['id'];

    // Persiapkan panggilan prosedur
    $query = "CALL deleteKaryawan(?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nik);

    // Eksekusi pernyataan SQL
    if ($stmt->execute()) {
        echo "<script>alert('Data karyawan berhasil dihapus.'); window.location.href = 'karyawan-data.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href = 'karyawan-data.php';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('ID karyawan tidak ditemukan.'); window.location.href = 'karyawan-data.php';</script>";
}

$conn->close();
?>