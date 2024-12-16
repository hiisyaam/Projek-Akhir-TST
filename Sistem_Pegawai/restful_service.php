<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Origin: *");

$method = $_SERVER['REQUEST_METHOD'];

function out($data, $http_code = 200) {
    http_response_code($http_code);
    echo json_encode($data);
    exit;
}

if ($method !== 'POST') {
    out(['status' => 'error', 'message' => 'Metode yang diperbolehkan hanya POST.'], 405);
}

$input = file_get_contents('php://input');
$requestData = json_decode($input, true);


if (json_last_error() !== JSON_ERROR_NONE) {
    $requestData = $_POST;
}

$nama = $requestData['cek'];

include '../Bank/database.php';


$stmt = $conn->prepare("SELECT nasabah.nama, history.aktivitas, history.tanggal 
                        FROM nasabah 
                        JOIN history ON nasabah.id = history.id_nasabah 
                        WHERE nasabah.nama = ? AND history.aktivitas = 'Gaji'");
$stmt->bind_param("s", $nama);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = [
        'nama' => $row['nama'],
        'aktivitas' => $row['aktivitas'],
        'tanggal' => $row['tanggal']
    ];
}

if (empty($data)) {
    out(['status' => 'error', 'message' => 'Data tidak ditemukan.'], 404);
}

// Return success response with data
out(['status' => 'success', 'data' => $data]);
?>
