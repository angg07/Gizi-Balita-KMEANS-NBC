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

//Mengambil dataset di database
if (mysqli_num_rows($query) > 0) {
    while ($data = mysqli_fetch_array($query)) {
        $datasetNormal[] = [
            $data['tb'],
            $data['bb'],
            $data['nama']
        ];
    }
}

// print("<pre>" . print_r($datasetNormal, true) . "</pre>");

//Status Gizi
$arrStatusGizi = array();

//Mencari Min MAX TInggi badan
$findTB = array_column($datasetNormal, 0);
$minTB = min($findTB);
$maxTB = max($findTB);
$rangeTB =  $maxTB - $minTB;

//Mencari Min MAX Berat badan
$findBB = array_column($datasetNormal, 1);
$minBB = min($findBB);
$maxBB = max($findBB);
$rangeBB = $maxBB - $minBB;

// print_r($maxBB);
$dataset = array();
foreach ($datasetNormal as $value) {
    $normalisasiTB = ($value[0] - $minTB) / $rangeTB;
    $normalisasiBB = ($value[1] - $minBB) / $rangeBB;
    $dataset[] = [
        $normalisasiTB,
        $normalisasiBB,
    ];
}


//Centroid 4
$centroid = [
    [0, 0],                     // Berat Badan Kurang(C0)
    [0.333333, 0.333333],       // Berat Badan Ideak(C1)
    [0.666667, 0.666667],       // Kegemukan(C2)
    [1, 1]                      // Obesitas(C4)
];
// print_r($centroid);

// Banyak Dataset
$banyak_dataset = sizeof($dataset); // 50
// echo "<br/>";
// echo ("Banyak Dataset : ");
// echo ($banyak_dataset);

// Banyak Centroid
$banyak_centroid = sizeof($centroid); // 5
// echo "<br/>";
// echo ("Banyak Centroid : ");
// echo ($banyak_centroid);

// Banyak Kolom
$banyak_kolom = sizeof($dataset[0]); // 2
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
        // print_r($hasil_euclid);
        // echo "<br/>";
        $nilai_terkecil = min($hasil_euclid);
        // print_r($nilai_terkecil);
        // echo "<br/>";
        $index_nilai_terkecil = array_search($nilai_terkecil, $hasil_euclid);
        // print_r($index_nilai_terkecil);
        // $label_cluster[$i] = $index_nilai_terkecil;
        $dataset_label[$i] = $index_nilai_terkecil;
    }

    // print_r($dataset_label);
    // echo "<br/>";


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
    // print_r($isi_cluster) ;


    // Menghitung centroid_baru tiap cluster
    $new_centroid = [];
    for ($i = 0; $i < $banyak_centroid; $i++) { // 5 X
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

// Print tabel hasil cluster
function print_hasil_cluster($dataset_label, $dataset, $banyak_dataset, $datasetNormal)
{ ?>
    <h3>HASIL CLUSTERING</h3>
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table display" id="datatables">
                        <tr>
                            <th>Data Ke</th>
                            <th>Nama</th>
                            <th>TB</th>
                            <th>BB</th>
                            <th>TB - Normalisasi</th>
                            <th>BB - Normalisasi</th>
                            <th>Label Cluster</th>
                        </tr>
                        <?php
                        $no = 0;

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
                                <td align='center'><?= $dataset[$i][0] ?></td>
                                <td align='center'><?= $dataset[$i][1] ?></td>
                                <td align='center'><?= $status_gizi ?></td>
                            </tr>

                        <?php $arrStatusGizi[] = $status_gizi;
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
    // print_r($dataset);
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

    $bmi = $mass / ($heightToMeters * $heightToMeters);

    return $bmi;
}
function hasil_cluster($dataset_label, $banyak_dataset, $datasetNormal)
{
    $no = 0;

    for ($i = 0; $i < $banyak_dataset; $i++) {
        $no++;

        $weight = $datasetNormal[$i][1];
        $height = $datasetNormal[$i][0];

        $BMI = BMI($weight, $height);
        if ($BMI <= 17) {
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
//-------------------------------------------------------------------   
//--------------------------- Start Metode --------------------------
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
}

print_hasil_cluster($dataset_label, $dataset, $banyak_dataset, $datasetNormal); // Menampilakn Hasil Cluster

function getModel()
{


    $classes = array('Berat Badan Kurang', 'Berat Badan Ideal', 'Kegemukan', 'Obesitas');
    $classField = 'result';

    $trainingSet = array();

    $hasil_clustering_Kmeans = hasil_cluster($GLOBALS['dataset_label'], $GLOBALS['banyak_dataset'], $GLOBALS['datasetNormal']);
    foreach ($hasil_clustering_Kmeans as $data) {
        $newTrainingSet = array(
            'BMI' => $data[0],
            'result' => $data[1]
        );

        array_push($trainingSet, $newTrainingSet);
    }

    // print("<pre>" . print_r($trainingSet, true) . "</pre>");
    // for ($i = 0; $i < 10000; $i++) {
    //     $newTrainingSet = array(
    //         'outlook' => $randomOutlook[array_rand($randomOutlook, 1)],
    //         'temperature' => $randomTemprature[array_rand($randomTemprature, 1)],
    //         'humidity' => $randomHumidity[array_rand($randomHumidity, 1)],
    //         'windy' => $randomWindy[array_rand($randomWindy, 1)],
    //         'result' => $randomResult[array_rand($randomResult, 1)]
    //     );

    //     array_push($trainingSet, $newTrainingSet);
    // }

    // print_r(sizeof($trainingSet));

    $params = array(
        'BMI' => 'OBESE',
        'result' => "Berat Badan Kurang"
    );

    return array(
        'classes' => $classes,
        'classField' => $classField,
        'trainingSet' => $trainingSet,
        'params' => $params
    );
}


$model = getModel();
$naiveBayes = new NaiveBayes($model['classes'], $model['classField'], $model['trainingSet'], $model['params']);

$naiveBayes->setCategoryOfAttribute('BMI', ['UNDERWEIGHT', 'NORMAL WEIGHT', 'OVERWEIGHT', 'OBESE']);

$classesResult = $naiveBayes->getResultProbabilityOfClassOnCondition(10);
$resultClass = $naiveBayes->getClassificationResult();
?>


<br><br>
<h3>Hasil Klasifikasi</h3>
<div class="col-sm-12">
    <div class="card">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table display" id="datatables">
                    <thead>
                        <tr>
                            <td>Class</td>
                            <td>Value</td>
                        </tr>
                    </thead>
                    <?php
                    foreach ($classesResult as $class => $value) {
                    ?>
                        <tbody>
                            <tr>
                                <td><?= $class ?></td>
                                <td><?= $value ?></td>
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