<?php
require 'vendor/autoload.php';
include_once '../../config/koneksi.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['submit'])) {
    $err = '';
    $ekstensi = '';
    $success = '';

    $file_name = $_FILES['filexls']['name'];
    $file_data = $_FILES['filexls']['tmp_name'];

    if (empty($file_name)) {
        $err .= '<li>Silahkan Masukkan File</li>';
    } else {
        $ekstensi = pathinfo($file_name)['extension'];
    }

    $ekstensi_allowed = array('xls', 'xlsx');
    if (!in_array($ekstensi, $ekstensi_allowed)) {
        $err .= "<li>Silahkan masukkan FIle xls atau xlsx. File yang kamu masukkan <b>$file_name</b> Bertipe <b>$ekstensi</b></li>";
    }

    if (empty($err)) {
        $reader = IOFactory::createReaderForFile($file_data);
        $spreadsheet = $reader->load($file_data);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        $jumlahData = 0;
        // echo $spreadsheet;
        for ($i = 1; $i < count($sheetData); $i++) {
            $nik = $sheetData[$i][1];
            $nama = $sheetData[$i][2];
            $tb = $sheetData[$i][3];
            $bb = $sheetData[$i][4];

            // echo $nik . " - " . $nama . " - " . $tb . " - " . $bb . "<br>";
            $sql = "INSERT INTO dataset (nik, nama, tb, bb) VALUES ('$nik', '$nama', '$tb', '$bb')";

            mysqli_query($conn, $sql);

            $jumlahData++;
        }

        if ($jumlahData > 0) {
            $success .= "<li>$jumlahData berhasil dimasukkan ke Database</li>";
        }
    }

    if ($err) { ?>
        <div class="alert alert-danger">
            <ul><?= $err ?></ul>
        </div>
    <?php }

    if ($success) { ?>
        <div class="alert alert-primary">
            <ul><?= $success ?></ul>
        </div>
<?php }
    header('Location: ../kmeans.php');
}
