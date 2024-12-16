<?php 
require 'service.php';
if (isset($_POST['submit'])) {
    $nama = $_POST['cek'];

    echo "Nama yang diinput: " . htmlspecialchars($nama);
    $status = cek(array("nama" => $nama));
    echo "<br>";
    echo "Status: " . $status['status'];
}

; ?>