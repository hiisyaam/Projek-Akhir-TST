<?php 
require 'service.php';
if (isset($_POST['submit'])) {
    $gaji_karyawan = array(
        "nama" => $_POST['nama'],
        "nominal_gaji" => $_POST['nominal_gaji']
    );

    $status = kirimGaji($gaji_karyawan);
    if ($status['status'] == "Sukses") {
        echo "Gaji berhasil dikirim. Bukti Transaksi: " . $status['bukti_transaksi'];
    } else {
        echo "Error: " . $status['status'];
    }
}


; ?>