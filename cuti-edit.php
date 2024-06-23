<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

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
                <!-- Nested Row within Card Body -->
                <!-- <div class="row"> -->
                <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                <!-- <div class="col-lg-7"> -->
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Edit cuti karyawan</h1>
                    </div>
                    <form class="user" action="cuti-update.php" method="POST" enctype="multipart/form-data">
                    <?php
                            include "conn.php";

                            if(isset($_GET['id'])) {
                                $id = $_GET['id'];

                                // Query untuk mendapatkan data cuti berdasarkan kode
                                $query = "SELECT * FROM cuti WHERE kode='$id'";
                                $result = $conn->query($query);

                                if($result->num_rows > 0) {
                                    $row = $result->fetch_assoc();
                        ?>
                        <input type="hidden" name="id" value="<?php echo $row['kode']; ?>">
                        <div class="form-group row">
                            <!-- <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="kode" name="kode" placeholder="KODE CUTI" required>
                            </div> -->
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="nik" name="nik" placeholder="NIK" value="<?php echo $row['nik']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="date" class="form-control form-control-user" id="tanggal_awal" name="tanggal_awal" placeholder="Tanggal awal cuti" value="<?php echo $row['tanggal_awal']; ?>">
                            </div>
                            <div class="col-sm-6">
                            <input type="date" class="form-control form-control-user" id="tanggal_akhir" name="tanggal_akhir" placeholder="Tanggal akhir cuti" value="<?php echo $row['tanggal_akhir']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="jumlah" name="jumlah" placeholder="Jumlah cuti diajukan" value="<?php echo $row['jumlah']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="jenis_cuti" name="jenis_cuti" placeholder="Jenis Cuti" value="<?php echo $row['jenis_cuti']; ?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="ket" name="ket" placeholder="Keterangan" value="<?php echo $row['ket']; ?>">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="date" class="form-control form-control-user" id="tanggal_masuk" name="tanggal_masuk" placeholder="tanggal masuk" value="<?php echo $row['tanggal_masuk']; ?>">
                            </div>
                        </div>
                        <div>
                        <div class="col-sm-6">
                                <label for="status">Status:</label><br>
                                <input type="radio" id="approved" name="status" value="Approved" <?php echo ($row['status'] == 'Approved') ? 'checked' : ''; ?>>
                                <label for="approved">Approved</label><br>
                                <input type="radio" id="pending" name="status" value="Pending" <?php echo ($row['status'] == 'Pending') ? 'checked' : ''; ?>>
                                <label for="pending">Pending</label><br>
                                <input type="radio" id="rejected" name="status" value="Rejected" <?php echo ($row['status'] == 'Rejected') ? 'checked' : ''; ?>>
                                <label for="rejected">Rejected</label><br><br>
                            </div>
                        </div>
                        <input class="btn btn-primary btn-user btn-block" type="submit" value="simpan">
                        <?php
                                    }
                                } else {
                                    echo "Data karyawan tidak ditemukan.";
                                }
                        ?>
                    </form>

                    <hr>
                    <!-- <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="login.html">Already have an account? Login!</a>
                            </div> -->
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