<?php 
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['submit'] =="Bikin") {
    $nama = $_POST['nasabah'];
    $norek = $_POST['no_rek'];

    $sql = "INSERT INTO nasabah (nama,rekening) VALUES ('$nama','$norek')";
    if(mysqli_query($conn, $sql)){
        echo "Data Berhasil Ditambahkan";
    }else{
        echo "Data Gagal Ditambahkan";
    }
}