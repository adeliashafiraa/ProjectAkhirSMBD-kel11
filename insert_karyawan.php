<?php
// Membuat koneksi
include "conn.php";

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $status = $_POST['status'];
    $jumlah_cuti = $_POST['jumlah_cuti'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];
    
    // Menyiapkan gambar
    $gambar = "uploads/" . basename($_FILES["gambar"]["name"]);

    // Memeriksa dan mengunggah file gambar
    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $gambar)) {
        // Menyiapkan query untuk memanggil stored procedure
        $sql = "CALL buatDataKaryawan(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        
        // Mengikat parameter
        $stmt->bind_param("sssssssssss", $nik, $nama, $tanggal_masuk, $departemen, $jabatan, $status, $jumlah_cuti, $username, $password, $level, $gambar);
        
        // Menjalankan query
        if ($stmt->execute()) {
            // Menangkap hasil dari stored procedure
            $result = $stmt->get_result();
            if ($result) {
                $row = $result->fetch_assoc();
                $keterangan = $row['keterangan'];
                
                // Menampilkan pesan sesuai dengan hasil stored procedure
                if ($keterangan == 'data telah ditambahkan') {
                    echo "<script>alert('Data berhasil dimasukkan.'); window.location.href = 'karyawan-data.php';</script>";
                } else {
                    echo "<script>alert('$keterangan'); window.location.href = 'form-tambah-karyawan.php';</script>";
                }
            } else {
                echo "<script>alert('Terjadi kesalahan pada server.'); window.location.href = 'form-tambah-karyawan.php';</script>";
            }
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Menutup statement
        $stmt->close();
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file.";
    }
}

// Menutup koneksi
$conn->close();
?>