<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>WorkPlus | Your Management TeamWorks</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tanggal masuk</th>
                        <th>Departemen</th>
                        <th>Jabatan</th>
                        <th>Status</th>
                        <th>Jumlah cuti</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Level</th>
                        <th>Gambar</th>
                        <th>aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Membuat koneksi
                    include "conn.php";

                    // Memeriksa koneksi
                    if ($conn->connect_error) {
                        die("Koneksi gagal: " . $conn->connect_error);
                    }

                    // Define the keyword
                    if (isset($_GET['keyword'])) {
                        $keyword = $_GET['keyword'];

                        // Prepare and execute the query
                        $sql = "SELECT 
                            nik AS Nik, 
                            nama AS Nama, 
                            tanggal_masuk AS tgl_masuk, 
                            departemen AS dept, 
                            jabatan AS jabatan, 
                            status AS stts, 
                            jumlah_cuti AS jumCuti, 
                            username AS Uname, 
                            password AS pw, 
                            level AS lv, 
                            gambar AS pict
                            FROM karyawan 
                            WHERE nik LIKE ? OR nama LIKE ?";

                        $stmt = $conn->prepare($sql);
                        $search_keyword = "%" . $keyword . "%";
                        $stmt->bind_param("ss", $search_keyword, $search_keyword);
                        $stmt->execute();

                        $result = $stmt->get_result();

                        // Check if results were returned
                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>".$row['Nik']."</td>";
                                echo "<td>".$row['Nama']."</td>";
                                echo "<td>".$row['tgl_masuk']."</td>";
                                echo "<td>".$row['dept']."</td>";
                                echo "<td>".$row['jabatan']."</td>";
                                echo "<td>".$row['stts']."</td>";
                                echo "<td>".$row['jumCuti']."</td>";
                                echo "<td>".$row['Uname']."</td>";
                                echo "<td>".$row['pw']."</td>";
                                echo "<td>".$row['lv']."</td>";
                                echo "<td><img src='".$row['pict']."' width='100' height='100'></td>";
                                echo "<td><a href='karyawan-edit.php?id=" . $row['Nik'] . "'>Edit</a> | <a href='karyawan-delete.php?id=" . $row['Nik'] . "'>Delete</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='12'>0 results</td></tr>";
                        }

                        // Close the statement and connection
                        $stmt->close();
                        $conn->close();
                    } else {
                        echo "<tr><td colspan='12'>Keyword tidak ditemukan. Silakan kembali dan masukkan keyword.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>