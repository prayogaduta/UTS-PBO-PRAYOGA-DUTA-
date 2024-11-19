<?php
include('koneksi.php');
$sql = "SELECT * FROM baju";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>id</th><th>nama_baju</th><th>warna</th><th>ukuran</th><th>harga</th></tr>";

    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nama_baju"] . "</td>";
        echo "<td>" . $row["warna"] . "</td>";
        echo "<td>". $row["ukuran"] . "</td>";
        echo "<td>". $row["harga"] ."</td>" ;
       
    }
    echo "</table>";
} else {
    echo "Tidak ada data ditemukan";
}

$conn->close();
?>
