<?php
include_once 'NaiveBayes.php';
include_once 'koneksi.php';

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
    <h5>Jarak Centroid Cluster</h5>
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

?>