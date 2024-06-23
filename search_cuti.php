<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkPlus | Table Cuti</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Table Cuti</h1>
    <p class="mb-4">Tabel data cuti karyawan yang ada di kantor.</p>

    <!-- Form Pencarian -->
    <form method="GET" action="">
        <div class="form-group">
            <label for="nik">Cari Berdasarkan NIK:</label>
            <input type="text" name="nik" id="nik" class="form-control" placeholder="Masukkan NIK">
        </div>
        <button type="submit" class="btn btn-primary">Cari</button>
    </form>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Cuti</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Kode Cuti</th>
                        <th>NIK</th>
                        <th>Tanggal Awal</th>
                        <th>Tanggal Akhir</th>
                        <th>Jumlah</th>
                        <th>Jenis Cuti</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    include "conn.php";

                    if (isset($_GET['nik'])) {
                        $nik = $_GET['nik'];

                        // Panggil stored procedure untuk pencarian data cuti berdasarkan NIK
                        $sql = "CALL searchCutiByNIK(?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $nik);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Menampilkan data dalam tabel
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row['kode']."</td>";
                                echo "<td>".$row['nik']."</td>";
                                echo "<td>".$row['tanggal_awal']."</td>";
                                echo "<td>".$row['tanggal_akhir']."</td>";
                                echo "<td>".$row['jumlah']."</td>";
                                echo "<td>".$row['jenis_cuti']."</td>";
                                echo "<td>".$row['ket']."</td>";
                                echo "<td>".$row['status']."</td>";
                                echo "<td><a href='cuti-edit.php?id=".$row['kode']."'>Edit</a> | <a href='cuti-hapus.php?id=".$row['kode']."'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>Data cuti tidak ditemukan</td></tr>";
                        }

                        // Tutup statement dan koneksi
                        $stmt->close();
                        $conn->close();
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
