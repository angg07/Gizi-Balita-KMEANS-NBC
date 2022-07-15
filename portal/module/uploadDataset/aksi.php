<?php
require 'vendor/autoload.php';
include_once '../../config/koneksi.php';

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

if (isset($_POST['deleteDataset'])) {
    //Delete user
    $sql = "DELETE FROM users WHERE level ='user'";

    mysqli_query($conn, $sql);
    mysqli_query($conn, 'TRUNCATE TABLE dataset');
}

if (isset($_POST['submit'])) {
    $err = '';
    $ekstensi = '';
    $success = '';
    $now   = date('Y-m-d H:i:s');
    $user  = 0;

    $file_name = $_FILES['filexls']['name'];
    $file_data = $_FILES['filexls']['tmp_name'];

    if (empty($file_name)) {
        $err .= "<li style='color:white;'>Silahkan Masukkan File</li>";
    } else {
        $ekstensi = pathinfo($file_name)['extension'];
    }

    $ekstensi_allowed = array('xls', 'xlsx');
    if (!in_array($ekstensi, $ekstensi_allowed)) {
        $err .= "<li style='color:white;'>Silahkan masukkan FIle xls atau xlsx. File yang kamu masukkan <b>$file_name</b> Bertipe <b>$ekstensi</b></li>";
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
            $email = $nik . '@email.com';
            $cariNik = mysqli_num_rows(mysqli_query($conn, "SELECT nik FROM dataset WHERE nik='$nik'"));
            $cariUser = mysqli_num_rows(mysqli_query($conn, "SELECT username FROM users WHERE username='$nik'"));

            // echo $cariNik;
            if ($cariNik > 0) {
                $sql = "UPDATE dataset SET nama='$nama', tb='$tb', bb='$bb' WHERE nik='$nik'";
            } else {
                // echo $nik . " - " . $nama . " - " . $tb . " - " . $bb . "<br>";
                $sql = "INSERT INTO dataset (nik, nama, tb, bb) VALUES ('$nik', '$nama', '$tb', '$bb')";
            }

            //Otomatis membuat login dengan username dan password dari nik
            if ($cariUser > 0) {
                $sql2 = "UPDATE users SET nama='$nama' WHERE username='$nik'";
            } else {
                $sql2 = "INSERT INTO users 
                            (username,
                            password,
                            nama,
                            level,
                            aktif,
                            no_telp,
                            email,
                            alamat,
                            created_by,
                            created_at,
                            updated_by,
                            updated_at
                            ) 
                VALUES 
                    ('" . $nik . "', 
                    '" . md5($nik) . "',
                    '$nama',
                    'user',
                    'Y',
                    '0',
                    '$email',
                    ' ',
                    '$user',
                    '$now',
                    '$user',
                    '$now'
                    )";
            }
            // echo $sql2;
            mysqli_query($conn, $sql);
            mysqli_query($conn, $sql2);

            $jumlahData++;
        }

        if ($jumlahData > 0) {
            $success .= "<li style='color:white;'>$jumlahData berhasil dimasukkan ke Database</li>";
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
    // header('Location: ../kmeans.php');
}
