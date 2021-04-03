<?php
include 'connect.php';
session_start();
header('Content-Type: application/json');
$hasil = mysqli_query($conn, "SELECT * FROM statusled ORDER BY tanggal DESC limit 1");
while($row = mysqli_fetch_assoc($hasil)) {
    $data = $row;
}
mysqli_close($conn);
echo json_encode($data, JSON_PRETTY_PRINT);
