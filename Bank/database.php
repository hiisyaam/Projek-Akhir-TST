<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'BankTST';

$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die ("Database belum terhubung !" . mysqli_connect_error());
}