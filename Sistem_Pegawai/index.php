<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pegawai Bank</title>
</head>
<body>
    <h2>FARIS HISYAM H</h2>
    <section>
        <h2>Cek History Gaji JSON</h2>
        <form action="restful_service.php" method="post">
            <label for="cek">Nama:</label>
            <input type="text" id="cek" name="cek" required>
            <input type="submit" name="submit" value="Lacak Data">
        </form>
    </section>

    <hr>

    <h2>ADINDA NAZWA</h2>
    <h2>Gaji Karyawan</h2>
        <form action="serviceadinda.php" method="post">
            <label for="nama">Nama Karyawan : </label>
            <input type="text" id="nama" name="nama" required>
            
            <label for="nominal_gaji">Nominal Gaji : </label>
            <input type="number" id="nominal_gaji" name="nominal_gaji" required>
            
            <input type="submit" name="submit" value="Kirim Gaji">
        </form>
    <hr>

    <h2>Auliya Zulfaa</h2>
    <section>
        <h2>Validasi Rekening Karyawan</h2>
        <form action="servicezulfa.php" method="post">
            <label for="cek">Nama:</label>
            <input type="text" id="cek" name="cek" required>
            <input type="submit" name="submit" value="Cek Norek">
        </form>
    </section>
</body>
</html>