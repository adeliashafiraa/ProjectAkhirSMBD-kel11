<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkPlus | Your Management TeamWorks | Edit Data Karyawan</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-primary">
    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Formulir untuk Mengedit Data Karyawan</h1>
                    </div>
                    <form class="user" action="karyawan-update.php" method="POST" enctype="multipart/form-data">
                        <?php
                            include "conn.php";

                            if(isset($_GET['id'])) {
                                $id = $_GET['id'];

                                // Query untuk mendapatkan data karyawan berdasarkan ID
                                $query = "SELECT * FROM karyawan WHERE nik='$id'";
                                $result = $conn->query($query);

                                if($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                        ?>
                        <input type="hidden" name="id" value="<?php echo $row['nik']; ?>">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama" value="<?php echo $row['nama']; ?>">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="date" class="form-control form-control-user" id="tanggal_masuk" name="tanggal_masuk" placeholder="Tanggal masuk" value="<?php echo $row['tanggal_masuk']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="departemen" name="departemen" placeholder="Departemen" value="<?php echo $row['departemen']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="jabatan" name="jabatan" placeholder="Jabatan" value="<?php echo $row['jabatan']; ?>">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="level">Level:</label><br>
                                <input type="radio" id="admin" name="level" value="Admin" <?php echo ($row['level'] == 'Admin') ? 'checked' : ''; ?>>
                                <label for="admin">Admin</label><br>
                                <input type="radio" id="superuser" name="level" value="Superuser" <?php echo ($row['level'] == 'Superuser') ? 'checked' : ''; ?>>
                                <label for="superuser">Superuser</label><br>
                                <input type="radio" id="user" name="level" value="User" <?php echo ($row['level'] == 'User') ? 'checked' : ''; ?>>
                                <label for="user">User</label><br><br>
                            </div>
                            <div class="col-sm-6">
                                <label for="status">Status:</label><br>
                                <input type="radio" id="tetap" name="status" value="TETAP" <?php echo ($row['status'] == 'TETAP') ? 'checked' : ''; ?>>
                                <label for="tetap">TETAP</label><br>
                                <input type="radio" id="pkwt" name="status" value="PKWT" <?php echo ($row['status'] == 'PKWT') ? 'checked' : ''; ?>>
                                <label for="pkwt">PKWT</label><br>
                                <input type="radio" id="pkwtt" name="status" value="PKWTT" <?php echo ($row['status'] == 'PKWTT') ? 'checked' : ''; ?>>
                                <label for="pkwtt">PKWTT</label><br><br>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="jumlah_cuti" name="jumlah_cuti" placeholder="Jumlah cuti" value="<?php echo $row['jumlah_cuti']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" value="<?php echo $row['username']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" value="<?php echo $row['password']; ?>">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <label for="gambar">URL Gambar:</label><br>
                                <input type="text" id="gambar" name="gambar" value="<?php echo $row['gambar']; ?>"><br>
                                <label for="gambar">Upload Gambar:</label><br>
                                <input type="file" id="gambar" name="gambar">
                            </div>
                        </div>
                        <input class="btn btn-primary btn-user btn-block" type="submit" value="Simpan Perubahan">
                        <?php
                                    }
                                } else {
                                    echo "Data karyawan tidak ditemukan.";
                                }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>