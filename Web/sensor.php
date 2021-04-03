<?php 
include 'connect.php';
    $jarak = $_GET['jarak'];
    $suhu = $_GET['suhu'];
    $intensitas = $_GET['intensitas'];
    $pompa = $_GET['pompa'];
    $lampu = $_GET['lampu'];
    $pakan = $_GET['pakan'];
    // if (empty($_GET['jarak'])) {
    //     $jarak = 0;
    // } else if (empty($_GET['suhu'])) {
    //     $suhu = 0;
    // } else if (empty($_GET['intensitas'])) {
    //     $intensitas = 0;
    // }
    $sql = "UPDATE statusled SET jarak = '".$jarak."', suhu = '".$suhu."', intensitas = '".$intensitas."', pompa = '".$pompa."', lampu = '".$lampu."', pakan = '".$pakan."', tanggal = current_timestamp() WHERE id = 1";
    if (mysqli_query($conn, $sql) === TRUE) {
        echo "OK";
    } else {
        echo "Error: ".$sql."<br>";
    }
 ?>