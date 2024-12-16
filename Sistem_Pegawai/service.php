<?php
function kirimGaji($gaji_karyawan) {
    // Include database di dalam fungsi
    include '../Bank/database.php';

    $nominal_gaji = $gaji_karyawan['nominal_gaji'];
    $nama = $gaji_karyawan['nama'];
    // $id_karyawan = $gaji_karyawan['id_karyawan'];
    // $tanggal = $gaji_karyawan['tanggal'];

    if (!is_numeric($nominal_gaji) || $nominal_gaji <= 0) {
        return array("status" => "Nominal gaji tidak valid", "bukti_transaksi" => null);
    }

    $query = "SELECT nama, saldo FROM nasabah WHERE nama = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $nama);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $nasabah = mysqli_fetch_assoc($result);
        $saldo_sekarang = $nasabah['saldo'];

        $saldo_baru = $saldo_sekarang + $nominal_gaji;

        $update_query = "UPDATE nasabah SET saldo = ? WHERE nama = ?";
        $update_stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($update_stmt, "is", $saldo_baru, $nama);
        $update_result = mysqli_stmt_execute($update_stmt);

        if ($update_result) {
            $bukti_transaksi = "Kode Transaksi" . uniqid();
            return array("status" => "Sukses", "bukti_transaksi" => $bukti_transaksi);
        } else {
            return array("status" => "Gagal memperbarui saldo", "bukti_transaksi" => null);
        }
    } else {
        return array("status" => "Karyawan Tidak Terdaftar sebagai Nasabah", "bukti_transaksi" => null);
    }
}

function cek($nama) {
    // Include database di dalam fungsi
    include '../Bank/database.php';

    // Query untuk mengambil semua nama dari tabel nasabah
    $query = "SELECT nama FROM nasabah";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        return array("status" => "Error pada query database: " . mysqli_error($conn));
    }

    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row['nama'];
    }

    // Periksa apakah nama yang diberikan ada dalam array $data
    $ketemuga = in_array($nama['nama'], $data);

    if ($ketemuga) {
        return array("status" => "Terdaftar");
    } else {
        return array("status" => "Tidak Terdaftar");
    }
}
?>