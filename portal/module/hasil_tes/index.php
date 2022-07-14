<?php
include_once '../../config/koneksi.php';
include_once '../../config/NaiveBayes.php';

// $datasetNormal = [
//     ['170', '50', 'NAMA'],
//     ['170', '53', 'NAMA'],
//     ['170', '53', 'NAMA'],
//     ['170', '53', 'NAMA'],
//     ['170', '53', 'NAMA'],
//     ['170', '80', 'NAMA'],

//     ['170', '94', 'NAMA'],
//     ['140', '92', 'NAMA'],
//     ['146', '100', 'NAMA'],
//     ['176', '131', 'NAMA'],
//     ['156', '113', 'NAMA'],
//     ['156', '113', 'NAMA'],

//     ['164', '63', 'NAMA'],
//     ['175', '77', 'NAMA'],
//     ['150', '38', 'NAMA'],
//     ['159', '52', 'NAMA'],
//     ['175', '62', 'NAMA'],
//     ['159', '42', 'NAMA']
// ];


$query = mysqli_query($conn, "SELECT * FROM dataset");
$datasetNormal = array();
$dataSetNormalIndexing = array();

//Mengambil dataset di database
if (mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_array($query)) {
        $datasetNormal[] = [
            $data['tb'],
            $data['bb'],
            $data['nama'],
            $data['nik'],
        ];

        $dataSetNormalIndexing[] = [
            'tb' => $data['tb'],
            'bb' => $data['bb'],
            'nama' => $data['nama'],
            'nik' => $data['nik'],
        ];
    }
}

// print("<pre>" . print_r($datasetNormal, true) . "</pre>");

//Status Gizi
$arrStatusGizi = array();

//Mencari Min MAX TInggi badan Normal
$findTB = array_column($datasetNormal, 0);
$minTB = min($findTB);
$maxTB = max($findTB);
$rangeTB =  $maxTB - $minTB;

//Mencari Min MAX Berat badan Normal
$findBB = array_column($datasetNormal, 1);
$minBB = min($findBB);
$maxBB = max($findBB);
$rangeBB = $maxBB - $minBB;


//Normalisasi Tinggi badan dan Berat Badan
$dataset = array();
foreach ($datasetNormal as $value) {
    $normalisasiTB = ($value[0] - $minTB) / $rangeTB;
    $normalisasiBB = ($value[1] - $minBB) / $rangeBB;
    $dataset[] = [
        $normalisasiTB,
        $normalisasiBB,
    ];
}


//Mencari Min MAX TInggi badan yang sudah di Normalisasi
$findTBNormalisasi = array_column($dataset, 0);
$minTBNormalisasi = min($findTBNormalisasi);
$maxTBNormalisasi = max($findTBNormalisasi);
$rangeTBNormalisasi =  $maxTBNormalisasi - $minTBNormalisasi;

//Mencari Min MAX Berat badan Normal
$findBBNormalisasi = array_column($dataset, 1);
$minBBNormalisasi = min($findBBNormalisasi);
$maxBBNormalisasi = max($findBBNormalisasi);
$rangeBBNormalisasi = $maxBBNormalisasi - $minBBNormalisasi;

$jarakCentroid = array(
    array(
        "index" => 0,
        "nama" => "Berat Badan Kurang",
        "tb" => ((($maxTBNormalisasi - $minTBNormalisasi) * (0 / 3)) / $rangeTBNormalisasi),
        "bb" => ((($maxBBNormalisasi - $minBBNormalisasi) * (0 / 3)) / $rangeBBNormalisasi),
    ),
    array(
        "index" => 1,
        "nama" => "Berat Badan Ideal",
        "tb" => ((($maxTBNormalisasi - $minTBNormalisasi) * (1 / 3)) / $rangeTBNormalisasi),
        "bb" => ((($maxBBNormalisasi - $minBBNormalisasi) * (1 / 3)) / $rangeBBNormalisasi),
    ),
    array(
        "index" => 2,
        "nama" => "Kegemukan",
        "tb" => ((($maxTBNormalisasi - $minTBNormalisasi) * (2 / 3)) / $rangeTBNormalisasi),
        "bb" => ((($maxBBNormalisasi - $minBBNormalisasi) * (2 / 3)) / $rangeBBNormalisasi),
    ),
    array(
        "index" => 3,
        "nama" => "Obesitas",
        "tb" => ((($maxTBNormalisasi - $minTBNormalisasi) * (3 / 3)) / $rangeTBNormalisasi),
        "bb" => ((($maxBBNormalisasi - $minBBNormalisasi) * (3 / 3)) / $rangeBBNormalisasi),
    ),
);
// print("<pre>" . print_r($jarakCentroid, true) . "</pre>");


//Menentukan Centroid 4
$centroid = array();
foreach ($jarakCentroid as $c) {
    $centroid[] = [
        round($c['tb'], 6),
        round($c['bb'], 6)
    ];
}

// print("<pre>" . print_r($centroid, true) . "</pre>");


// Banyak Dataset
$banyak_dataset = sizeof($dataset);
// echo "<br/>";
// echo ("Banyak Dataset : ");
// echo ($banyak_dataset);

// Banyak Centroid
$banyak_centroid = sizeof($centroid);
// echo "<br/>";
// echo ("Banyak Centroid : ");
// echo ($banyak_centroid);

// Banyak Kolom
$banyak_kolom = sizeof($dataset[0]);
// echo "<br/>";
// echo ("Banyak Kolom : ");
// echo ($banyak_kolom);
// echo "<br/>";
// echo "<br/>";


// Fungsi euclidean distance
function hitung_euclidean_distance($dataset, $centroid, $banyak_kolom)
{

    // print_r($banyak_kolom);
    $siat = 0;
    for ($i = 0; $i < $banyak_kolom; $i++) { // 2 X
        $siat = $siat + (($dataset[$i] - $centroid[$i]) ** 2);
    }

    return sqrt($siat);
}


// Iterasi K-Means
function iterasi_kmeans($dataset, $centroid, $banyak_dataset, $banyak_centroid, $banyak_kolom)
{

    $dataset_label = [];
    // $label_cluster = [];
    for ($i = 0; $i < $banyak_dataset; $i++) { // 50X
        $hasil_euclid = [];
        for ($j = 0; $j < $banyak_centroid; $j++) { // 5X
            $hasil_euclid[$j] = hitung_euclidean_distance($dataset[$i], $centroid[$j], $banyak_kolom);
        }
        // print("<pre>" . print_r($hasil_euclid, true) . "</pre>");

        $nilai_terkecil = min($hasil_euclid);
        // print("<pre>" . print_r($nilai_terkecil, true) . "</pre>");


        $index_nilai_terkecil = array_search($nilai_terkecil, $hasil_euclid);
        // print("<pre>" . print_r($index_nilai_terkecil, true) . "</pre>");

        $label_cluster[$i] = $index_nilai_terkecil;
        $dataset_label[$i] = $index_nilai_terkecil;
    }

    // print("<pre>" . print_r($dataset_label, true) . "</pre>");


    // Mengelompokkan dataset berdasarkan cluster
    $isi_cluster = [];  // array 3 dimensi
    for ($x = 0; $x < $banyak_centroid; $x++) {
        $array_siat = [];
        for ($y = 0; $y < $banyak_dataset; $y++) {
            if ($dataset_label[$y] == $x) {
                array_push($array_siat, $dataset[$y]);
            }
        }
        $isi_cluster[$x] = $array_siat;
    }
    // print("<pre>" . print_r($isi_cluster, true) . "</pre>");


    // Menghitung centroid_baru tiap cluster
    $new_centroid = [];
    for ($i = 0; $i < $banyak_centroid; $i++) { // 4 X
        $hasil_centroid = [];
        for ($j = 0; $j < $banyak_kolom; $j++) {  // 2 X
            $temp_centroid = 0;
            for ($k = 0; $k < sizeof($isi_cluster[$i]); $k++) { // sebanyak tiap2 cluster        
                $temp_centroid = $temp_centroid + $isi_cluster[$i][$k][$j];
            }
            $hasil_centroid[$j] = $temp_centroid / sizeof($isi_cluster[$i]);
        }
        $new_centroid[$i] = $hasil_centroid;
    }

    return [$new_centroid, $dataset_label];
}

// function BMI($mass, $height)
// {
//     $massToPounds = ($mass * 2.20462) * 703;
//     $heightToInches = ($height * 0.393701);
//     $heightToInchesQuad = $heightToInches * $heightToInches;

//     $bmi = $massToPounds / $heightToInchesQuad;
//     return $bmi;
// }

function BMI($mass, $height)
{
    $heightToMeters = $height / 100;
    $bmi = $mass / ($heightToMeters ** 2);

    return $bmi;
}

function BMIWithLabel($mass, $height)
{
    $heightToMeters = $height / 100;
    $BMI = $mass / ($heightToMeters ** 2);

    if ($BMI <= 18.5) {
        $messageBMI = "UNDERWEIGHT";
    } else if ($BMI > 17 && $BMI <= 23) {
        $messageBMI = "NORMAL WEIGHT";
    } else if ($BMI > 23 && $BMI <= 27) {
        $messageBMI = "OVERWEIGHT";
    } else if ($BMI > 27) {
        $messageBMI = "OBESE";
    }

    return $messageBMI;
}

function searchForNik($id, $array)
{
    foreach ($array as $key => $val) {
        if ($val['nik'] === $id) {
            return $key;
        }
    }
    return null;
}

// Print tabel hasil cluster
function print_hasil_cluster($dataset_label, $dataset, $banyak_dataset, $datasetNormal)
{ ?>
    <h3>HASIL CLUSTERING</h3>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table display" id="datatables">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>TB</th>
                                <th>BB</th>
                                <th>TB - Normalisasi</th>
                                <th>BB - Normalisasi</th>
                                <th>Hasil IMT</th>
                                <th>Label Cluster</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            if ($_SESSION['level'] == 'admin') {

                                for ($i = 0; $i < $banyak_dataset; $i++) {
                                    $no++;
                                    if ($dataset_label[$i] == 0) {
                                        $status_gizi = "Berat Badan Kurang";
                                    } elseif ($dataset_label[$i] == 1) {
                                        $status_gizi = "Berat Badan Ideal";
                                    } elseif ($dataset_label[$i] == 2) {
                                        $status_gizi = "Kegemukan";
                                    } elseif ($dataset_label[$i] == 3) {
                                        $status_gizi = "Obesitas";
                                    } else {
                                        $status_gizi = "Tidak Ada";
                                    }
                            ?>
                                    <tr>
                                        <td align='center'><?= $no ?></td>
                                        <td><?= $datasetNormal[$i][2] ?></td>
                                        <td align='center'><?= $datasetNormal[$i][0] ?></td>
                                        <td align='center'><?= $datasetNormal[$i][1] ?></td>
                                        <td align='center'><?= round($dataset[$i][0], 6) ?></td>
                                        <td align='center'><?= round($dataset[$i][1], 6) ?></td>
                                        <td align='center'><?= BMIWithLabel($datasetNormal[$i][1], $datasetNormal[$i][0]) ?></td>
                                        <td align='center'><?= $status_gizi ?></td>
                                    </tr>

                                <?php $arrStatusGizi[] = $status_gizi;
                                }
                            } else {
                                // var_dump($_SESSION['username']);
                                $dataSetNormalIndexing = $GLOBALS['dataSetNormalIndexing'];

                                $filterBy = $_SESSION['username']; // or Finance etc.

                                //Search NIK
                                $arrayNik = array_filter($dataSetNormalIndexing, function ($var) use ($filterBy) {
                                    return ($var['nik'] == $filterBy);
                                });

                                $nikKey = array_search($filterBy, array_column($dataSetNormalIndexing, 'nik'));
                                // print("<pre>" . print_r($key, true) . "</pre>");

                                $no++;
                                if ($dataset_label[$nikKey] == 0) {
                                    $status_gizi = "Berat Badan Kurang";
                                } elseif ($dataset_label[$nikKey] == 1) {
                                    $status_gizi = "Berat Badan Ideal";
                                } elseif ($dataset_label[$nikKey] == 2) {
                                    $status_gizi = "Kegemukan";
                                } elseif ($dataset_label[$nikKey] == 3) {
                                    $status_gizi = "Obesitas";
                                } else {
                                    $status_gizi = "Tidak Ada";
                                } ?>
                                <tr>
                                    <td align='center'><?= $no ?></td>
                                    <td><?= $datasetNormal[$nikKey][2] ?></td>
                                    <td align='center'><?= $datasetNormal[$nikKey][0] ?></td>
                                    <td align='center'><?= $datasetNormal[$nikKey][1] ?></td>
                                    <td align='center'><?= round($dataset[$nikKey][0], 6) ?></td>
                                    <td align='center'><?= round($dataset[$nikKey][1], 6) ?></td>
                                    <td align='center'><?= BMIWithLabel($datasetNormal[$nikKey][1], $datasetNormal[$nikKey][0]) ?></td>
                                    <td align='center'><?= $status_gizi ?></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
    // print_r($dataset);
}

function printCentroidLabel($jarakCentroid)
{ ?>
    <br><br>
    <h3>Jarak Centroid Cluster</h3>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table display">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Cluster</td>
                                <td>Tinggi badan</td>
                                <td>Berat Badan</td>
                            </tr>
                        </thead>
                        <?php
                        foreach ($jarakCentroid as  $labelCentroid) {
                        ?>
                            <tbody>
                                <tr>
                                    <td><?= $labelCentroid['index'] + 1 ?></td>
                                    <td><b><?= $labelCentroid['nama'] ?></b></td>
                                    <td><?= round($labelCentroid['tb'], 6) ?></td>
                                    <td><?= round($labelCentroid['bb'], 6) ?></td>

                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
}



function hasil_cluster($dataset_label, $banyak_dataset, $datasetNormal)
{
    $no = 0;

    for ($i = 0; $i < $banyak_dataset; $i++) {
        $no++;

        $weight = $datasetNormal[$i][1];
        $height = $datasetNormal[$i][0];

        $BMI = BMI($weight, $height);
        if ($BMI <= 18.5) {
            $messageBMI = "UNDERWEIGHT";
        } else if ($BMI > 17 && $BMI <= 23) {
            $messageBMI = "NORMAL WEIGHT";
        } else if ($BMI > 23 && $BMI <= 27) {
            $messageBMI = "OVERWEIGHT";
        } else if ($BMI > 27) {
            $messageBMI = "OBESE";
        }


        if ($dataset_label[$i] == 0) {
            $status_gizi = "Berat Badan Kurang";
        } elseif ($dataset_label[$i] == 1) {
            $status_gizi = "Berat Badan Ideal";
        } elseif ($dataset_label[$i] == 2) {
            $status_gizi = "Kegemukan";
        } elseif ($dataset_label[$i] == 3) {
            $status_gizi = "Obesitas";
        } else {
            $status_gizi = "Tidak Ada";
        }
        $arrStatusGizi[] = [
            $messageBMI,
            $status_gizi
        ];
    }

    return $arrStatusGizi;
}

function getModel()
{

    //Classs Berdasarkan Centroid Kmeans
    $classes = array('Berat Badan Kurang', 'Berat Badan Ideal', 'Kegemukan', 'Obesitas');
    $classField = 'result';

    $trainingSet = array();
    $hasil_clustering_Kmeans = hasil_cluster($GLOBALS['dataset_label'], $GLOBALS['banyak_dataset'], $GLOBALS['datasetNormal']);
    foreach ($hasil_clustering_Kmeans as $data) {
        $trainingSet[] = [
            'BMI' => $data[0],
            'result' => $data[1]
        ];
    }

    // print("<pre>" . print_r($trainingSet, true) . "</pre>");


    $params = array(
        // 'BMI' => 'OBESE',
        'result' => "Berat Badan Kurang"
    );

    return array(
        'classes' => $classes,
        'classField' => $classField,
        'trainingSet' => $trainingSet,
        'params' => $params
    );
}




//-------------------------------------------------------------------   
//---------------------- Start Metode Kmeans ------------------------
//-------------------------------------------------------------------

// echo "Centroid Awal : ";
// print_r($centroid);
// echo "<br/>";

// Perulangan iterasi kmeans
$centroid_temp = [];
$ulang = TRUE;
while ($ulang) {
    # code...
    $centroid_dan_datasetlabel = iterasi_kmeans($dataset, $centroid, $banyak_dataset, $banyak_centroid, $banyak_kolom);
    // print_r($centroid_dan_datasetlabel);

    $centroid = $centroid_dan_datasetlabel[0];  // centroid akan berubah-ubah saat perulangan
    $dataset_label = $centroid_dan_datasetlabel[1];  // dataset_label akan berubah-ubah saat perulangan

    if ($centroid == $centroid_temp) { // Membandingkan nilai centroid, jika sama iterasi berhenti.
        $ulang = FALSE;
    }

    $centroid_temp = $centroid;

    // echo "<br/>";
    // echo "Centroid baru : ";
    // print_r($centroid); // tampilkan nilai centroid
    // echo "<br/>";
    // echo "<br/>";
} ?>

<?php
$dataArrayFilter = array();
$hasilHasil = hasil_cluster($dataset_label, $banyak_dataset, $datasetNormal);

foreach ($hasilHasil as $DAF) {
    $dataArrayFilter[] = [
        'stats' => $DAF[1]
    ];
}

$filterKurang = 'Berat Badan Kurang';
$filterIdeal = 'Berat Badan Ideal';
$filterKegemukan = 'Kegemukan';
$filterObesitas = 'Obesitas';

$dataKurang = array_count_values(array_column($dataArrayFilter, 'stats'))[$filterKurang];
$dataIdeal = array_count_values(array_column($dataArrayFilter, 'stats'))[$filterIdeal];
$dataKegemukan = array_count_values(array_column($dataArrayFilter, 'stats'))[$filterKegemukan];
$dataObesitas = array_count_values(array_column($dataArrayFilter, 'stats'))[$filterObesitas];
$totalData = $dataKurang + $dataIdeal + $dataKegemukan + $dataObesitas;

$jumlahDataFilter[] = [
    'kurang' => $dataKurang,
    'ideal' => $dataIdeal,
    'kegemukan' => $dataKegemukan,
    'obesitas' => $dataObesitas
];

// print("<pre>" . print_r($jumlahDataFilter, true) . "</pre>");


print_hasil_cluster($dataset_label, $dataset, $banyak_dataset, $datasetNormal); // Menampilakn Hasil Cluster
printCentroidLabel($jarakCentroid); // Menampilakn Label Cluster


//-------------------------------------------------------------------   
//---------------------- Start Metode NBC ---------------------------
//-------------------------------------------------------------------
$model = getModel();
$naiveBayes = new NaiveBayes($model['classes'], $model['classField'], $model['trainingSet'], $model['params']);

// $naiveBayes->setCategoryOfAttribute('BMI', ['UNDERWEIGHT', 'NORMAL WEIGHT', 'OVERWEIGHT', 'OBESE']);

$classesResult = $naiveBayes->getResultProbabilityOfClassOnCondition(10);
$resultClass = $naiveBayes->getClassificationResult();
?>


<br><br>
<h3>Hasil Klasifikasi</h3>
<div class="col-sm-12">
    <div class="card">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <style type="text/css">
                    .tg {
                        border-collapse: collapse;
                        border-spacing: 0;
                    }

                    .tg td {
                        border-color: black;
                        border-style: solid;
                        border-width: 1px;
                        font-family: Arial, sans-serif;
                        font-size: 14px;
                        overflow: hidden;
                        padding: 10px 5px;
                        word-break: normal;
                    }

                    .tg th {
                        border-color: black;
                        border-style: solid;
                        border-width: 1px;
                        font-family: Arial, sans-serif;
                        font-size: 14px;
                        font-weight: normal;
                        overflow: hidden;
                        padding: 10px 5px;
                        word-break: normal;
                    }

                    .tg .tg-9wq8 {
                        border-color: inherit;
                        text-align: center;
                        vertical-align: middle
                    }

                    .tg .tg-c3ow {
                        border-color: inherit;
                        text-align: center;
                        vertical-align: top
                    }

                    .tg .tg-0pky {
                        border-color: inherit;
                        text-align: left;
                        vertical-align: top
                    }
                </style>
                <table class="tg table display table-bordered">
                    <thead>
                        <tr>
                            <th class="tg-c3ow">#</th>
                            <th class="tg-c3ow" colspan="4" style="border-right: 1px solid #B5B5B5;"><b>Jumlah Kategori Status Gizi</b></th>
                            <th class="tg-c3ow" colspan="4"><b>Probabilitas Kategori Status Gizi</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tg-9wq8" rowspan="2" style="border-right: 1px solid #B5B5B5;">Jumlah</td>
                            <td class="tg-c3ow"><b></b>Berat Badan Kurang</td>
                            <td class="tg-c3ow"><b>Berat&nbsp;&nbsp;Badan Ideal</td>
                            <td class="tg-c3ow"><b>Kegemukan</td>
                            <td class="tg-c3ow" style="border-right: 1px solid #B5B5B5;"><b>Obesitas</td>
                            <td class="tg-c3ow"><b>Berat Badan Kurang</td>
                            <td class="tg-c3ow"><b>Berat Badan Ideal</td>
                            <td class="tg-c3ow"><b>Kegemukan</td>
                            <td class="tg-c3ow"><b>Obesitas</td>
                        </tr>
                        <tr>
                            <td class="tg-c3ow"><?= $dataKurang; ?></td>
                            <td class="tg-c3ow"><?= $dataIdeal; ?></td>
                            <td class="tg-c3ow"><?= $dataKegemukan; ?></td>
                            <td class="tg-c3ow"><?= $dataObesitas; ?></td>
                            <td class="tg-c3ow" style="border-left: 1px solid #B5B5B5;"><?= $dataKurang . " / " . $totalData ?></td>
                            <td class="tg-c3ow"><?= $dataIdeal . " / " . $totalData ?></td>
                            <td class="tg-c3ow"><?= $dataKegemukan . " / " . $totalData ?></td>
                            <td class="tg-c3ow"><?= $dataObesitas . " / " . $totalData ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br><br>
<div class="col-sm-12">
    <div class="card">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table display" id="datatables">
                    <thead>
                        <tr>
                            <td><b>No</b></td>
                            <td><b>Class</b></td>
                            <td><b>Value</b></td>
                        </tr>
                    </thead>
                    <?php
                    $no = 0;
                    foreach ($classesResult as $class => $value) {
                        $no++;
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $class ?></td>
                                <td><?= round($value * 100, 2) ?>%</td>
                            </tr>
                        </tbody>
                    <?php } ?>
                    <tfoot>
                        <tr>
                            <td colspan="2">Mayoritas balita di Puskesmas Cibaregbeg, Memiliki status <b><?= $resultClass ?></b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>