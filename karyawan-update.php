<?php
include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa apakah data telah dikirim melalui metode POST
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        // Mengambil nilai ID karyawan dari input form
        $id = $_POST['id'];
        
        // Mengambil nilai data lainnya dari input form
        $nama = $_POST['nama'];
        $tanggal_masuk = $_POST['tanggal_masuk'];
        $departemen = $_POST['departemen'];
        $jabatan = $_POST['jabatan'];
        $status = $_POST['status'];
        $jumlah_cuti = $_POST['jumlah_cuti'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $level = $_POST['level'];
        
        // Mengambil nilai gambar
        $gambar = $_POST['gambar'];

        // Memeriksa apakah file gambar diupload
        if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Memeriksa apakah file adalah gambar asli
            $check = getimagesize($_FILES["gambar"]["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Memeriksa apakah file sudah ada
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Memeriksa ukuran file
            if ($_FILES["gambar"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Memeriksa format file
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Memeriksa apakah $uploadOk bernilai 0 karena ada kesalahan
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
            // Jika semua pengecekan lolos, mencoba mengupload file
            } else {
                if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
                    $gambar = $target_file; // Menyimpan path file yang diupload
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
        }

        // Menggunakan stored procedure untuk update data karyawan
        $stmt = $conn->prepare("CALL updateKaryawan(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssss", $id, $nama, $tanggal_masuk, $departemen, $jabatan, $status, $jumlah_cuti, $username, $password, $level, $gambar);

        // Eksekusi stored procedure
        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil diperbarui'); window.location.href = 'karyawan-data.php';</script>";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        $stmt->close();
    } else {
        echo "ID karyawan tidak ditemukan.";
    }
} else {
    echo "Metode pengiriman data bukan POST.";
}

// Menutup koneksi
$conn->close();
?>