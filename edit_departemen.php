<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WorkPlus | Edit Departemen</title>
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
                    <h1 class="h4 text-gray-900 mb-4">Formulir untuk Mengedit Departemen</h1>
                </div>
                <form class="user" action="update-departemen.php" method="POST">
                    <?php
                    include "conn.php";

                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        // Panggil stored procedure untuk mendapatkan data departemen berdasarkan ID
                        $sql = "CALL getDepartemenById(?)";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("s", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                    ?>
                    <input type="hidden" name="id" value="<?php echo $row['id_dept']; ?>">
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama_dept" name="nama_dept" placeholder="Nama Departemen" value="<?php echo $row['nama_dept']; ?>">
                    </div>
                    <input class="btn btn-primary btn-user btn-block" type="submit" value="Simpan Perubahan">
                    <?php
                        } else {
                            echo "Data departemen tidak ditemukan.";
                        }
                        $stmt->close();
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
