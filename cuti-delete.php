<?php
// Membuat koneksi
include "conn.php";

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil kode dari form atau query string
    $kode = $_POST['kode'] ?? null;

    if ($kode) {
        // Query untuk menghapus data cuti
        $sql_delete = "DELETE FROM cuti WHERE kode = ?";
        $stmt = $conn->prepare($sql_delete);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("s", $kode);

        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil dihapus.'); window.location.href = 'tabel-cuti.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Menutup statement
        $stmt->close();
    } else {
        echo "Kode cuti harus disertakan.";
    }
}

// Menutup koneksi
$conn->close();
?>