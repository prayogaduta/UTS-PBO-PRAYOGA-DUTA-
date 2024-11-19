<?php
include 'koneksi.php';

$sql = "SELECT * FROM baju";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Data Baju</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-image: url('bg/bg.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.6);
            z-index: 1;
        }

        .content {
            position: relative;
            z-index: 2;
            color: #ffffff;
        }

        h1, h2 {
            color: #ff0000;
        }

        .form-label {
            color: #ddd;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 8px;
            color: #ffffff;
            display: none;
        }

        .table-container {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 8px;
            color: #ffffff;
        }

        table {
            color: #fff;
        }
        table tbody tr td {
            color: #ffffff !important;
        }

        .btn-edit {
            background-color: #ffc107;
            color: #fff;
            border: none;
            transition: 0.3s;
        }
        .btn-edit {
            display: inline-block;
            outline: 0;
            border: 0;
            cursor: pointer;
            font-weight: 600;
            color: #ffffff;
            font-size: 14px;
            height: 38px;
            padding: 8px 24px;
            border-radius: 50px;
            background-image: linear-gradient(180deg, #f5d300, #ffcc00);
            box-shadow: 0 4px 11px 0 rgb(37 44 97 / 15%), 0 1px 3px 0 rgb(93 100 148 / 20%);
            transition: all .2s ease-out;0 8px 22px 0 rgb(37 44 97 / 15%), 0 4px 6px 0 rgb(93 100 148 / 20%);
        }           
        .btn-delete {
            background-color: #dc3545;
            color: #fff;
            border: none;
            transition: 0.3s;
        }
        .btn-delete {
           
            display: inline-block;
            outline: 0;
            border: 0;
            cursor: pointer;
            font-weight: 600;
            color: #fff;
            font-size: 14px;
            height: 38px;
            padding: 8px 24px;
            border-radius: 50px;
            background-image: linear-gradient(180deg, #ff4d4d, #ff0000); 
            box-shadow: 0 4px 11px 0 rgb(37 44 97 / 15%), 0 1px 3px 0 rgb(93 100 148 / 20%);
            transition: all .2s ease-out;
        }

        
        .btn-primary {             
            display: inline-block;
            outline: 0;
            border: 0;
            cursor: pointer;
            font-weight: 600;
            color: #fff;
            font-size: 14px;
            height: 38px;
            padding: 8px 24px;
            border-radius: 50px;
            background-image: linear-gradient(180deg,#7c8aff,#3c4fe0);
            box-shadow: 0 4px 11px 0 rgb(37 44 97 / 15%), 0 1px 3px 0 rgb(93 100 148 / 20%);
            transition: all .2s ease-out;               
            box-shadow: 0 8px 22px 0 rgb(37 44 97 / 15%), 0 4px 6px 0 rgb(93 100 148 / 20%);
        }   
    </style>
</head>
<body>
    <div class="overlay"></div>
    <div class="content">
        <header class="py-5 text-center">
            <div class="container">
                <h1 class="display-5 fw-bold">Data Baju</h1>
            </div>
        </header>

        <div class="text-center mb-4">
            <a href="add_data.php" class="btn btn-dark">Tambah Data</a>
        </div>

        <div class="container my-5">
            <div class="table-container">
                <h2 class="mb-4">Daftar Baju</h2>
                <?php if ($result->num_rows > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Baju</th>
                                    <th>Warna</th>
                                    <th>ukuran</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?= $row["id"]; ?></td>
                                        <td><?= $row["nama_baju"]; ?></td>
                                        <td><?= $row["warna"]; ?></td>
                                        <td><?= $row["ukuran"]; ?></td>
                                        <td><?= $row["harga"]; ?></td>
                                        <td>
                                            <a href="edit_data.php?id=<?= $row["id"]; ?>" class="btn btn-edit btn-sm">Edit</a>
                                            <a href="delete_data.php?id=<?= $row["id"]; ?>" class="btn btn-delete btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-center">Tidak ada data ditemukan</p>
                <?php endif; ?>
                <?php $conn->close(); ?>
            </div>
        </div>
    </div>
    <script>
        function toggleForm() {
            var formContainer = document.getElementById("formContainer");
            var toggleButton = document.getElementById("toggleFormButton");

            if (formContainer.style.display === "none" || formContainer.style.display === "") {
                formContainer.style.display = "block";
                toggleButton.innerText = "Sembunyikan Form";
            } else {
                formContainer.style.display = "none";
                toggleButton.innerText = "Tambah Data";
            }
        }
    </script>
</body>
</html>
