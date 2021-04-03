<?php 
include 'connect.php';
    $pompa = $_POST['sP'];
    $lampu = $_POST['sL'];
    $feeder = $_POST['sF'];
    $otomatis = $_POST['auto'];
    if (empty($_POST['sP'])) {
        $pompa = 0;
    } else if (empty($_POST['sL'])) {
        $lampu = 0;
    } else if (empty($_POST['sF'])) {
        $feeder = 0;
    }
    $sql = "UPDATE statusled SET pompa = '".$pompa."', lampu = '".$lampu."', pakan = '".$feeder."', otomatis = '".$otomatis."', tanggal = current_timestamp() WHERE id = 1";
    if (mysqli_query($conn, $sql) === TRUE) {
        echo "OK";
    } else {
        echo "Error: ".$sql."<br>";
    }
 ?>