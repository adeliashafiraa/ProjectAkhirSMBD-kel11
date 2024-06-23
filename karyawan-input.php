<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WorkPlus | Your Management TeamWorks</title>

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
                        <h1 class="h4 text-gray-900 mb-4">Input data karyawan</h1>
                    </div>
                    <form class="user" action="insert_karyawan.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="nik" name="nik" placeholder="NIK" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="date" class="form-control form-control-user" id="tanggal_masuk" name="tanggal_masuk" placeholder="Tanggal masuk" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="departemen" name="departemen" placeholder="Departemen" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="jabatan" name="jabatan" placeholder="Jabatan" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="level">Level:</label><br>
                                <input type="radio" id="admin" name="level" value="Admin" required>
                                <label for="admin">Admin</label><br>
                                <input type="radio" id="superuser" name="level" value="Superuser">
                                <label for="superuser">Superuser</label><br>
                                <input type="radio" id="user" name="level" value="User">
                                <label for="user">User</label><br><br>
                            </div>
                            <div class="col-sm-6">
                                <label for="status">Status:</label><br>
                                <input type="radio" id="tetap" name="status" value="TETAP" required>
                                <label for="tetap">TETAP</label><br>
                                <input type="radio" id="pkwt" name="status" value="PKWT">
                                <label for="pkwt">PKWT</label><br>
                                <input type="radio" id="pkwtt" name="status" value="PKWTT">
                                <label for="pkwtt">PKWTT</label><br><br>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="jumlah_cuti" name="jumlah_cuti" placeholder="Jumlah cuti" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="username" name="username" placeholder="Username" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" required>
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="file" class="form-control form-control-user" id="pict" name="gambar" required>
                            </div>
                        </div>
                        <input class="btn btn-primary btn-user btn-block" type="submit" value="simpan">
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