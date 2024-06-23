<?php
session_start();
include 'conn.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $tanggal_masuk = $_POST['tanggal_masuk'];
    $departemen = $_POST['departemen'];
    $jabatan = $_POST['jabatan'];
    $status = $_POST['status'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    // Menyiapkan statement untuk memanggil stored procedure
    $stmt = $conn->prepare("CALL TambahKaryawan(?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sssssssss", $nik, $nama, $tanggal_masuk, $departemen, $jabatan, $status, $username, $password, $level);
        $stmt->execute();
        $stmt->close();

        // Redirect ke halaman sukses atau lainnya
        header("Location: login.php");
        exit();
    } else {
        $error = "Error: " . $conn->error;
    }
}

// Lanjutkan dengan proses simpan data ke database


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WorkPlus | Your Management TeamWorks | Registrasi</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru</h1>
                        </div>
                        <form action="" method="POST">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="nik" placeholder="NIK" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="nama" placeholder="Nama Lengkap" required>
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control form-control-user" name="tanggal_masuk" placeholder="Tanggal Masuk" required>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-user" name="departemen" required>
                                    <option value="">Pilih Departemen</option>
                                    <!-- Options Departemen dari Database -->
                                    <?php
                                    include 'conn.php';
                                    $query = "SELECT id_dept, nama_dept FROM departemen";
                                    $result = $conn->query($query);
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['nama_dept'] . "'>" . $row['nama_dept'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-user" name="jabatan" required>
                                    <option value="">Pilih Jabatan</option>
                                    <!-- Options Jabatan dari Database -->
                                    <?php
                                    $query = "SELECT id_jabatan, jabatan FROM jabatan";
                                    $result = $conn->query($query);
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['jabatan'] . "'>" . $row['jabatan'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control form-control-user" name="status" required>
                                    <option value="">Pilih Status Karyawan</option>
                                    <option value="TETAP">Tetap</option>
                                    <option value="PKWT">PKWT</option>
                                    <option value="PKWTT">PKWTT</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="username" placeholder="Username" required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-user" name="password" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" name="level" placeholder="level" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block" href = "login.php">
                                Register Account
                            </button>
                            <hr>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="login.php">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>