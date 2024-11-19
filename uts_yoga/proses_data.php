<?php
include 'koneksi.php';

$action = $_GET['action'];

if ($action == 'create') {
    $id = $_POST['id'];
    $nama_baju = $_POST['nama_baju'];
    $warna = $_POST['warna'];
    $ukuran = $_POST['ukuran'];
    $harga = $_POST['harga'];
   
    $query = "INSERT INTO baju (id, nama_baju, warna, ukuran, harga) VALUES ('$id, '$nama_baju', '$warna', '$ukuran', '$harga')";
    $conn->query($query);

    header("Location: index.php");
} elseif ($action == 'delete') {
    $id = $_GET['id'];
    $query = "DELETE FROM baju WHERE id_ = $id";
    $conn->query($query);

    header("Location: index.php");
}
?>