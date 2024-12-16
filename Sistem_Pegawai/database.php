<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'KaryawanTST';

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die ("Database belum terhubung !" . mysqli_connect_error());
}