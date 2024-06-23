<?php
include "conn.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Panggil stored procedure untuk menghapus data departemen
    $sql = "CALL deleteDepartemen(?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href = 'departemen.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
