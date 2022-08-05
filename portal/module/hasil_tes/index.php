<?php
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
$SAMPLES = array();
$LABELS = array();

//Mengambil dataset di database
if (mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_array($query)) {
        $datasetNormal[] = [
            $data['tb'],
            $data['bb'],
            $data['nama'],
            $data['nik'],
            $data['jenisData']
        ];

        $dataSetNormalIndexing[] = [
            'tb' => $data['tb'],
            'bb' => $data['bb'],
            'nama' => $data['nama'],
            'nik' => $data['nik'],
            'jenisData' => $data['jenisData']
        ];

        $SAMPLES[] = [
            $data['tb'],
            $data['bb']
        ];

        $LABELS[] = BMIWithLabel($data['bb'], $data['tb']);
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

// print("<pre>" . print_r($dataset, true) . "</pre>");

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

    // print("<pre>" . print_r($siat, true) . "</pre>");
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
    // print("<pre>" . print_r($new_centroid, true) . "</pre>");

    return [$new_centroid, $dataset_label];
}

// Print tabel hasil cluster
function print_hasil_cluster($dataset_label, $dataset, $banyak_dataset, $datasetNormal, $jarakCentroid)
{ ?>
    <br><br>
    <h3>Hasil K-Means Clustering</h3>
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
                                        $status_gizi = $jarakCentroid[0]['nama'];
                                    } elseif ($dataset_label[$i] == 1) {
                                        $status_gizi = $jarakCentroid[1]['nama'];
                                    } elseif ($dataset_label[$i] == 2) {
                                        $status_gizi = $jarakCentroid[2]['nama'];
                                    } elseif ($dataset_label[$i] == 3) {
                                        $status_gizi = $jarakCentroid[3]['nama'];
                                    } else {
                                        $status_gizi = "Tidak Ada";
                                    }

                                    if ($datasetNormal[$i][4] == 'testing') {
                                        $dataJenis = 'class="table-success"';
                                    }
                            ?>
                                    <tr <?= $dataJenis; ?>>
                                        <td align='center'><?= $no ?></td>
                                        <td><?= $datasetNormal[$i][2] ?></td>
                                        <td align='center'><?= $datasetNormal[$i][0] ?></td>
                                        <td align='center'><?= $datasetNormal[$i][1] ?></td>
                                        <td align='center'><?= round($dataset[$i][0], 6) ?></td>
                                        <td align='center'><?= round($dataset[$i][1], 6) ?></td>
                                        <td align='center'><?= BMIWithLabel($datasetNormal[$i][1], $datasetNormal[$i][0]) ?></td>
                                        <td align='center' class='bg-info text-white'><?= $status_gizi ?></td>
                                    </tr>

                                <?php $arrStatusGizi[] = $status_gizi;
                                }
                            } else {
                                // var_dump($_SESSION['username']);
                                $dataSetNormalIndexing = $GLOBALS['dataSetNormalIndexing'];

                                $filterBy = $_SESSION['username'];

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
                                }
                                $IMT = BMIWithLabel($datasetNormal[$nikKey][1], $datasetNormal[$nikKey][0]);
                                ?>
                                <tr>
                                    <td align='center'><?= $no ?></td>
                                    <td><?= $datasetNormal[$nikKey][2] ?></td>
                                    <td align='center'><?= $datasetNormal[$nikKey][0] ?></td>
                                    <td align='center'><?= $datasetNormal[$nikKey][1] ?></td>
                                    <td align='center'><?= round($dataset[$nikKey][0], 6) ?></td>
                                    <td align='center'><?= round($dataset[$nikKey][1], 6) ?></td>
                                    <td align='center'><?= $IMT ?></td>
                                    <td align='center' class='bg-primary'><?= $status_gizi ?></td>
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
    <h5>Centroid Awal</h5>
    <div class=" col-sm-12">
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
            // 'BMI' => $data[0],
            'result' => $data[1]
        ];
    }

    // print("<pre>" . print_r($trainingSet, true) . "</pre>");


    $params = array(
        // 'BMI' => 'UNDERWEIGHT',
        'result' => "Berat badan Ideal"
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
$IMTArray = array();
$hasilHasil = hasil_cluster($dataset_label, $banyak_dataset, $datasetNormal);

foreach ($hasilHasil as $DAF) {
    $dataArrayFilter[] = [
        'IMT' => $DAF[0],
        'stats' => $DAF[1]
    ];
}

// print_r($dataArrayFilter);


//-------------------------------------------------------------------   
//------------------------------- Nilai Data ------------------------
//-------------------------------------------------------------------
//FIlter IMT
$filterUnder = 'Underweight';
$filterNormal = 'Normal weight';
$filterOver = 'Overweight';
$filterObese = 'Obese';

$dataUnder = array_count_values(array_column($dataArrayFilter, 'IMT'))[$filterUnder];
$dataNormal = array_count_values(array_column($dataArrayFilter, 'IMT'))[$filterNormal];
$dataOver = array_count_values(array_column($dataArrayFilter, 'IMT'))[$filterOver];
$dataObese = array_count_values(array_column($dataArrayFilter, 'IMT'))[$filterObese];
$totalDataIMT = $dataUnder + $dataNormal + $dataOver + $dataObese;

$jumlahDataIMTFilter[] = [
    'under' => $dataUnder,
    'normal' => $dataNormal,
    'over' => $dataOver,
    'obese' => $dataObese
];

//Filter Status Gizi
$filterKurang = $jarakCentroid[0]['nama'];
$filterIdeal = $jarakCentroid[1]['nama'];
$filterKegemukan = $jarakCentroid[2]['nama'];
$filterObesitas = $jarakCentroid[3]['nama'];

$dataKurang = array_count_values(array_column($dataArrayFilter, 'stats'))[$filterKurang];
$dataIdeal = array_count_values(array_column($dataArrayFilter, 'stats'))[$filterIdeal];
$dataKegemukan = array_count_values(array_column($dataArrayFilter, 'stats'))[$filterKegemukan];
$dataObesitas = array_count_values(array_column($dataArrayFilter, 'stats'))[$filterObesitas];
$totalDataStatus = $dataKurang + $dataIdeal + $dataKegemukan + $dataObesitas;

$jumlahDataStatusFilter[] = [
    'kurang' => $dataKurang,
    'ideal' => $dataIdeal,
    'kegemukan' => $dataKegemukan,
    'obesitas' => $dataObesitas
];


$alkurasiKurang = ($dataUnder + $banyak_dataset) / (($dataUnder + $banyak_dataset) + $dataKurang);
$akurasiIdeal = ($dataNormal + $banyak_dataset) / (($dataNormal + $banyak_dataset) + $dataIdeal);
$akurasiKegemukan = ($dataOver + $banyak_dataset) / (($dataOver + $banyak_dataset) + $dataKegemukan);
$akurasiObesitas = ($dataObese + $banyak_dataset) / (($dataObese + $banyak_dataset) + $dataObesitas);
$totalAkurasi = ($alkurasiKurang + $akurasiIdeal + $akurasiKegemukan + $akurasiObesitas) / 4;

// print("<pre>" . print_r($jumlahDataIMTFilter, true) . "</pre>");
// print("<pre>" . print_r($jumlahDataStatusFilter, true) . "</pre>");




//-------------------------------------------------------------------   
//---------------------- Start Metode NBC ---------------------------
//-------------------------------------------------------------------\

//Test Data For NBC
$TEST = array();
for ($i = 0; $i < 139; $i++) {
    $TEST[] = [
        $SAMPLES[$i][0],
        $SAMPLES[$i][1],
    ];
}

$model = getModel();
$naiveBayes = new NaiveBayes($model['classes'], $model['classField'], $model['trainingSet'], $model['params']);

// $naiveBayes->setCategoryOfAttribute('BMI', ['UNDERWEIGHT', 'NORMAL WEIGHT', 'OVERWEIGHT', 'OBESE']);

$classesResult = $naiveBayes->getResultProbabilityOfClassOnCondition(10);
$resultClass = $naiveBayes->getClassificationResult();
?>


<?php
print_hasil_cluster($dataset_label, $dataset, $banyak_dataset, $datasetNormal, $jarakCentroid); // Menampilakn Hasil Cluster
?>

<!----- Jarak Centroid dan RUMUS IMT ----->
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <?php
            // Menampilakn Label Cluster
            printCentroidLabel($jarakCentroid);
            ?>
        </div>
        <div class="col-sm-6">
            <br><br>
            <h5>Rumus IMT</h5>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table display">
                                <thead>
                                    <tr>
                                        <td>Indeks massa tubuh (IMT) = berat badan (kg) : tinggi badan (m)²</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <ul>
                                                <li>Kurang IMT < 18,5</li>
                                                <li>Ideal 18,5 < IMT < 24,9</li>
                                                <li>Gemuk 25 < IMT < 29,9</li>
                                                <li>Obesitas 30 < IMT</li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!----- Persentase Clustering ----->
<br><br>
<div class="col-sm-12">
    <div class="card">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table display">
                    <thead>
                        <tr>
                            <td><b>No</b></td>
                            <td><b>Label Cluster</b></td>
                            <td><b>Value</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        $valueNBC = array();
                        foreach ($classesResult as $class => $value) {
                            $no++;
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $class ?></td>
                                <td><?= round($value * 100, 2) ?>%</td>
                            </tr>
                        <?php
                            $valueNBC[] = [
                                round($value * 100, 2)
                            ];
                        }
                        // print_r($valueNBC[1]);
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3">Mayoritas balita di Puskesmas Cibaregbeg, Memiliki status <b><?= $resultClass ?></b></td>
                        </tr>
                        <!-- <tr>
                            <td colspan="3">Akurasi Probabilitas : <b><?= round($totalAkurasi * 100, 2); ?>%</b></td>
                        </tr> -->
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<!----- Hasil Tabel Naive Bayes Classification ----->
<!-- <br><br>
<div class="col-sm-12">
    <div class="card">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table display" id="datatables2">
                    <thead>
                        <tr>
                            <td><b>No</b></td>
                            <td><b>Nama</b></td>
                            <td><b>Naive Bayes</b></td>
                            <td><b>K-Means</b></td>
                            <td><b>Hasil Perbandingan</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 0;
                        for ($i = 0; $i < $banyak_dataset; $i++) {
                            $no++;
                            $NB = new NaiveBayesClassification();
                            $NB->train($SAMPLES, $LABELS);
                            $PREDICTED[] = $NB->predict($TEST[$i]);
                            $PROBABILITAS[] = $NB->predictProbabilitas($TEST[$i]);

                            $hasilCek = CekIMTStatus($PREDICTED[$i], $dataArrayFilter[$i]['stats']);
                            // echo "<br>";
                            // echo $PREDICTED;
                        ?>
                            <tr>
                                <td><?= $no ?></td>
                                <td><?= $datasetNormal[$i][2] ?></td>
                                <td><?= $PREDICTED[$i] ?></td>
                                <td><?= $dataArrayFilter[$i]['stats'] ?></td>
                                <td><?= $hasilCek ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> -->