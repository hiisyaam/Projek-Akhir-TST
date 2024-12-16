<?php
require 'vendor/econea/nusoap/src/nusoap.php';
require 'vendor/autoload.php';
require 'service.php';

$namespace_gaji = "urn:gajiKaryawan";
$namespace_validasi = "urn:validasiNasabah";

$server = new soap_server();
$server->configureWSDL("gajiKaryawan", $namespace_gaji);
$server->configureWSDL("validasiNasabah", $namespace_validasi);
$server->wsdl->schemaTargetNamespace = $namespace_gaji;

// Tipe kompleks untuk kirimGaji
$server->wsdl->addComplexType(
    'gaji_karyawan',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'nama' => array('name' => 'nama', 'type' => 'xsd:string'),
        'id_karyawan' => array('name' => 'id_karyawan', 'type' => 'xsd:string'),
        'nominal_gaji' => array('name' => 'nominal_gaji', 'type' => 'xsd:decimal'),
        'tanggal' => array('name' => 'tanggal', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'respon_transaksi',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'status' => array('name' => 'status', 'type' => 'xsd:string'),
        'bukti_transaksi' => array('name' => 'bukti_transaksi', 'type' => 'xsd:string')
    )
);

// Tipe kompleks untuk cek validasi nasabah
$server->wsdl->addComplexType(
    'nasabah_karyawan',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'nama' => array('name' => 'nama', 'type' => 'xsd:string')
    )
);

$server->wsdl->addComplexType(
    'respon',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'status' => array('name' => 'status', 'type' => 'xsd:string')
    )
);

// Registrasi method kirimGaji
$server->register(
    'kirimGaji',
    array('gaji_karyawan' => 'tns:gaji_karyawan'),
    array('respon_transaksi' => 'tns:respon_transaksi'),
    $namespace_gaji,
    false,
    'rpc',
    'encoded',
    'Kirim nominal gaji karyawan ke bank dan terima bukti transaksi jika berhasil'
);

// Registrasi method cek validasi nasabah
$server->register(
    'cek',
    array('nasabah_karyawan' => 'tns:nasabah_karyawan'),
    array('respon' => 'tns:respon'),
    $namespace_validasi,
    false,
    'rpc',
    'encoded',
    'Cari Validasi apakah Karyawan sudah jadi nasabah di Bank'
);

$POST_DATA = file_get_contents("php://input");
$server->service($POST_DATA);
exit();
?>