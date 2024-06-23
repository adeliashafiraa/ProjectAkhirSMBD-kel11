<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<?php
include "conn.php"; // Menyertakan file koneksi
$startDate = '2018-06-29'; // Ganti dengan tanggal awal yang diinginkan
$endDate = '2024-07-30';   // Ganti dengan tanggal akhir yang diinginkan

$sql = "CALL GetCutiKaryawan(?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $startDate, $endDate);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}
$stmt->close();

?>

<?php
// Parameter departemen
$id_departemen1 = 'D4098';
$id_departemen2 = 'D5120';
$id_departemen3 = 'D5273';

// Menyiapkan statement untuk memanggil stored procedure
$stmt1 = $conn->prepare("CALL DataJumlahDepartemen(?, ?, ?)");
$stmt1->bind_param("sss", $id_departemen1, $id_departemen2, $id_departemen3);

// Menjalankan stored procedure
$stmt1->execute();
$result = $stmt1->get_result();

// Mengambil hasil
$departments = array();
while($row = $result->fetch_assoc()) {
    $departments[] = $row;
}

// Menutup statement dan koneksi
$stmt1->close();
?>

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
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include "sidebar.php"; ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <?php include "navbartop.php"; ?>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard Performa</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                               Jumlah karyawan</div>
                                            <div id="employeeCount" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                                        </div>
                                        <div class="col-auto">
                                            <!-- <i class="fas fa-calendar fa-2x text-gray-300"></i> -->
                                            <?php
                                                // Query untuk menampilkan hasil view
                                                $sql = "SELECT * FROM vw_jumKaryawan";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                    // Output data of each row
                                                    while($row = $result->fetch_assoc()) {
                                                        echo $row["jumlah_karyawan"] . " orang karyawan" ;
                                                    }
                                                } else {
                                                    echo "0 hasil";
                                                }

                                                ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Jumlah Departemen</div>
                                        </div>
                                        <div class="col-auto">
                                        <?php
                                        // Query untuk menampilkan hasil view
                                        $sql_show_view = "SELECT * FROM vw_jumDepartement";
                                        $result = $conn->query($sql_show_view);

                                        if ($result->num_rows > 0) {
                                            // Output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                echo $row["jumlah_departemen"] . " departemen";
                                            }
                                        } else {
                                            echo "0 hasil";
                                        }

                                        ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Jabatan
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <!-- <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <?php
                                        // Query untuk menampilkan hasil view
                                        $sql_show_view = "SELECT * FROM vw_jumJabatan";
                                        $result = $conn->query($sql_show_view);

                                        if ($result->num_rows > 0) {
                                            // Output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                echo " Total ada " . $row["jumlah_jabatan"] . " jabatan";
                                            }
                                        } else {
                                            echo "0 hasil";
                                        }

                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- cuti approved -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Cuti Requests (Approved)</div>
                                        </div>
                                        <div class="col-auto">
                                        <?php
                                        // Query untuk menampilkan hasil view
                                        $sql_show_view = "SELECT * FROM vw_reqCutiRejected";
                                        $result = $conn->query($sql_show_view);

                                        if ($result->num_rows > 0) {
                                            // Output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                echo $row["jumlah_reqCutiRejected"] . " cuti approved";
                                            }
                                        } else {
                                            echo "0 hasil";
                                        }

                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- cuti pending -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Cuti Requests (Pending)</div>
                                        </div>
                                        <div class="col-auto">
                                        <?php
                                        // Query untuk menampilkan hasil view
                                        $sql_show_view = "SELECT * FROM vw_reqCutiPending";
                                        $result = $conn->query($sql_show_view);

                                        if ($result->num_rows > 0) {
                                            // Output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                echo $row["jumlah_reqCutiPending"] . " cuti pending";
                                            }
                                        } else {
                                            echo "0 hasil";
                                        }

                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- cuti rejected -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Cuti Requests (Rejected)</div>
                                        </div>
                                        <div class="col-auto">
                                        <?php
                                        // Query untuk menampilkan hasil view
                                        $sql_show_view = "SELECT * FROM vw_reqCutiRejected";
                                        $result = $conn->query($sql_show_view);

                                        if ($result->num_rows > 0) {
                                            // Output data of each row
                                            while($row = $result->fetch_assoc()) {
                                                echo $row["jumlah_reqCutiRejected"] . " cuti rejected";
                                            }
                                        } else {
                                            echo "0 hasil";
                                        }

                                        ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Lihat Lebih detil:</div>
                                            <a class="dropdown-item" href="#">Detail</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        <div class="col-lg-6 mb-4">
                            <!-- Project Card Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Data Banyak Departemen</h6>
                                </div>
                                <div class="card-body">
                                    <?php
                                    // Menampilkan progress bar berdasarkan hasil dari stored procedure
                                    foreach ($departments as $dept) {
                                        // Menghitung persentase sebagai contoh, misal berdasarkan EmployeeCount
                                        $percentage = ($dept['EmployeeCount'] / 100) * 100; // Sesuaikan perhitungan dengan kebutuhan Anda
                                        $percentage = min(100, max(0, $percentage)); // Batas persentase antara 0 dan 100
                                        $progressBarColor = 'bg-success'; // Anda bisa menyesuaikan warna progress bar

                                        echo "
                                        <h4 class='small font-weight-bold'>{$dept['DepartmentName']} <span class='float-right'>{$percentage}%</span></h4>
                                        <div class='progress mb-4'>
                                            <div class='progress-bar {$progressBarColor}' role='progressbar' style='width: {$percentage}%' aria-valuenow='{$percentage}' aria-valuemin='0' aria-valuemax='100'></div>
                                        </div>
                                        ";
                                    }
                                    ?>
                                    <p>Data diatas merupakan hasil visualisasi data dari banyaknya departemen yang ada serta jumlah karyawan yang termasuk dalam departemen tersebut.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">WorkPlus</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 25rem;"
                                            src="img/illustration_description.svg" alt="...">
                                    </div>
                                    <p>WorkPlus merupakan website pencatatan karyawan yang memiliki segudang fitur serta visualisasi data yang menarik. Anda tidak perlu melihat jumlah data yang begitu
                                        banyak, sehingga dapat membuat anda pusing. WorkPlus dapat membantu anda untuk menampilkan data karyawan yang diperlukan.</p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include "footer.php"; ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout dari tampilan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Apakah Anda ingin keluar dari WorkPlus?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="index.php?logout=true">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <script>
        var chartData = <?php echo json_encode($data); ?>;
    </script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php
    $conn->close();
    ?>


</body>

</html>