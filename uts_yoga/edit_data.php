<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM baju WHERE id = ?");
    $stmt->bind_param("i", $id);  // 'i' untuk integer (id)
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<p>Data tidak ditemukan</p>";
        echo "<a href='index.php'>Kembali ke halaman utama</a>";
        exit();
    }
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_baju = $_POST['nama_baju'];
    $warna = $_POST['warna'];
    $ukuran = $_POST['ukuran'];
    $harga = $_POST['harga'];

    // Perbaiki statement untuk bind_param
    $stmt = $conn->prepare("UPDATE baju SET nama_baju = ?, warna = ?, ukuran = ?, harga = ? WHERE id = ?");
    $stmt->bind_param("sssdi", $nama_baju, $warna, $ukuran, $harga, $id); // 'sssdi' untuk string, string, string, decimal, integer

    if ($stmt->execute()) {
        header("Location: index.php"); // Redirect ke index.php
        exit();
    } else {
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Baju</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-image: url('bg/bg.png'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #ffffff;
        }
        .container {
            background-color: rgba(0, 0, 0, 0.7); 
            padding: 20px;
            border-radius: 8px;
            max-width: 600px;
            margin-top: 80px;
        }
        h2 {
            color: #fff;
        }
        label {
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <h2>Edit Data Baju</h2>
        <!-- Form yang benar -->
        <form action="edit_data.php" method="POST">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">

            <div class="mb-3 text-start">
                <label for="nama_baju" class="form-label">Nama Baju</label>
                <input type="text" id="nama_baju" name="nama_baju" class="form-control" value="<?php echo htmlspecialchars($row['nama_baju']); ?>" required>
            </div>
           
            <div class="mb-3 text-start">
                <label for="warna" class="form-label">Warna</label>
                <input type="text" id="warna" name="warna" class="form-control" value="<?php echo htmlspecialchars($row['warna']); ?>" required>
            </div>

            <div class="mb-3 text-start">
                <label for="ukuran" class="form-label">Ukuran</label>
                <input type="text" id="ukuran" name="ukuran" class="form-control" value="<?php echo htmlspecialchars($row['ukuran']); ?>" required>   
            </div>

            <div class="mb-3 text-start">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" id="harga" name="harga" class="form-control" value="<?php echo htmlspecialchars($row['harga']); ?>" required>
            </div>
          
            <button type="submit" class="btn btn-warning w-100 mb-3">Simpan Perubahan</button>
            <a href="index.php" class="btn btn-secondary w-100 mb-2">Batal</a>
        </form>
    </div>
</body>
</html>
