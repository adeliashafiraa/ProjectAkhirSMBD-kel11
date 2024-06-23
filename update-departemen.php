<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_dept = $_POST['nama_dept'];

    // Panggil stored procedure untuk memperbarui data departemen
    $sql = "CALL updateDepartemen(?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $id, $nama_dept);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui.'); window.location.href = 'departemen.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
