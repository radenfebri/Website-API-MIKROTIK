<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "latihanapi";

    $conn = mysqli_connect($servername, $username, $password, $databasename);
    if(!$conn){
        die("Koneksi tidak berhasil");
    }
?>