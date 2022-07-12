<?php
$tampil_metode = false;
$tampil_metode = true;
$query = mysqli_query($conn, "SELECT * from isi_jawaban where session_key = '" . $_GET['key'] . "'");
$detail = mysqli_fetch_array($query);
$users = mysqli_fetch_array(mysqli_query($conn, "SELECT * from users where id = '" . $detail['id_user'] . "'"));
$info = $detail['info'];
$bb = json_decode(@$info, true)['bb'];
$tb = json_decode(@$info, true)['tb'];
$jml_resp = mysqli_num_rows(mysqli_query($conn, "SELECT * from isi_jawaban group by session_key"));
?>
<style type="text/css">
  .active {
    background-color: #cb0d9e;
    color: white;
  }
</style>
<div class="row">
  <div class="col-sm-12">
    <?php
    if (isset($_SESSION['flash'])) : ?>
      <div class="<?php echo $_SESSION['flash']['class']; ?> mt-3 mb-3 alert-dismissible fade show">
        <span class="text-white">
          <i class="<?php echo $_SESSION['flash']['icon'] ?>"></i>
          <?php echo $_SESSION['flash']['label']; ?>
        </span>
        <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
      </div>
    <?php endif ?>
  </div>
  <div class="col-sm-12 mb-5">
    <div class="card">
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table">
            <tr>
              <td>Nama</td>
              <td colspan="1"><b class="text-primary"><?php echo $users['nama'] ?></b></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Telpon</td>
              <td><?php echo $users['no_telp'] ?></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Email</td>
              <td><?php echo $users['email'] ?></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td class="text-wrap"><?php echo $users['alamat'] ?></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Berat Badan (kg)</td>
              <td>
                <?php echo $bb ?>
              </td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Tinggi Badan (cm)</td>
              <td>
                <?php echo $tb ?>
              </td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Tanggal Cek</td>
              <td colspan="1"><?php echo explode(" ", $detail['created_at'])[0] ?></td>
              <td></td>
              <td></td>
            </tr>
            <tr>
              <td>Waktu Cek</td>
              <td colspan="1"><?php echo explode(" ", $detail['created_at'])[1] ?></td>
              <td></td>
              <td></td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-12 mb-5">
    <div class="card">
      <div class="card-header">
        <h3>
          <b class="text-primary">Hasil IMT</b>
        </h3>
      </div>
      <div class="card-body pb-2">
        <div class="table-responsive p-0">
          <table class="table">
            <tr>
              <td>
                Indeks massa tubuh (IMT) = berat badan (kg) : tinggi badan (m)²
              </td>
            </tr>
            <tr>
              <td>
                <ul>
                  <li>Kurang IMT < 18,5</li>
                  <li>Ideal 18,5 < IMT < 24,9</li>
                  <li>Gemuk 25 < IMT < 29,9</li>
                  <li>Obesitas 30 < IMT </li>
                </ul>
              </td>
            </tr>
            <tr>
              <td>
                IMT = <?php
                      $res = $bb / pow($tb / 100, 2);
                      echo $bb . " / " . ($tb / 100) . "<sup>2</sup> = " . round($res, 2);
                      echo "<br>";
                      echo "Hasil IMT adalah <b class='text-primary'>" . IMT($res) . "</b>";
                      ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php if ($tampil_metode) : ?>
    <div class="col-sm-12 mb-5">
      <div class="card">
        <div class="card-header">
          <h3>
            <b class="text-primary">K-Means</b>
          </h3>
          <p>
          </p>
        </div>
        <div class="card-body pb-2">
          <h3 class="mt-3">Data set</h3>
          <div class="table-responsive p-0">
            <table class="table">
              <thead>
                <th>No</th>
                <th hidden>Nama</th>
                <th>Tinggi Badan (cm)</th>
                <th>Berat Badan (kg)</th>
                <th>Hasil IMT</th>
              </thead>
              <tbody>
                <?php
                $no = 0;
                $query = mysqli_query($conn, "SELECT * from isi_jawaban group by session_key order by created_at desc");
                foreach ($query as $row) : $no++;
                  $user = mysqli_fetch_array(mysqli_query($conn, "SELECT * from users where id = $row[id_user]"));
                  $active = $row['session_key'] == $_GET['key'] ? 'active' : '';
                  $json = json_decode($row['info'], true);
                  $IMT[$row['session_key']] = $json['bb'] / pow($json['tb'] / 100, 2);
                  $data['tb'][] = $json['tb'];
                  $data['bb'][] = $json['bb'];
                ?>
                  <tr class="<?= $active ?>">
                    <td><?= $no ?></td>
                    <td hidden><?= $user['nama'] ?></td>
                    <td><?= $json['tb'] ?></td>
                    <td><?= $json['bb'] ?></td>
                    <td title="IMT: <?= round($IMT[$row['session_key']], 2) ?>"><?= IMT($IMT[$row['session_key']]) ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <h3 class="mt-3">Centroid Cluster</h3>
          <div class="table-responsive p-0">
            <table class="table">
              <thead>
                <th>No</th>
                <th>Cluster</th>
                <th>Tinggi Badan</th>
                <th>Berat Badan</th>
              </thead>
              <tbody>
                <?php
                $no = 0;
                $point['tb']['max']   = (int)max($data['tb']);
                $point['tb']['min']   = (int)min($data['tb']);
                $point['tb']['range'] = (int)($point['tb']['max'] - $point['tb']['min']);
                $point['bb']['max']   = (int)max($data['bb']);
                $point['bb']['min']   = (int)min($data['bb']);
                $point['bb']['range'] = (int)($point['bb']['max'] - $point['bb']['min']);
                $indexIMT = array(
                  array(
                    "index" => 0,
                    "nama" => "Berat Badan Kurang",
                    "tb" => ((($point['tb']['max'] - $point['tb']['min']) * (0 / 3)) / $point['tb']['range']),
                    "bb" => ((($point['bb']['max'] - $point['bb']['min']) * (0 / 3)) / $point['bb']['range']),
                  ),
                  array(
                    "index" => 1,
                    "nama" => "Berat Badan Ideal",
                    "tb" => ((($point['tb']['max'] - $point['tb']['min']) * (1 / 3)) / $point['tb']['range']),
                    "bb" => ((($point['bb']['max'] - $point['bb']['min']) * (1 / 3)) / $point['bb']['range']),
                  ),
                  array(
                    "index" => 2,
                    "nama" => "Kegemukan",
                    "tb" => ((($point['tb']['max'] - $point['tb']['min']) * (2 / 3)) / $point['tb']['range']),
                    "bb" => ((($point['bb']['max'] - $point['bb']['min']) * (2 / 3)) / $point['bb']['range']),
                  ),
                  array(
                    "index" => 3,
                    "nama" => "Obesitas",
                    "tb" => ((($point['tb']['max'] - $point['tb']['min']) * (3 / 3)) / $point['tb']['range']),
                    "bb" => ((($point['bb']['max'] - $point['bb']['min']) * (3 / 3)) / $point['bb']['range']),
                  ),
                );
                // print_r($indexIMT);
                foreach ($indexIMT as $key => $value) : $no++;
                ?>
                  <tr>
                    <td><?= $no ?></td>
                    <td><?php echo $value['nama'] ?></td>
                    <td><?php echo round($value['tb'], 6) ?></td>
                    <td><?php echo round($value['bb'], 6) ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
          <h3 class="mt-3">Data set</h3>
          <div class="table-responsive p-0">
            <table class="table">
              <thead>
                <tr>
                  <th rowspan="2">No</th>
                  <th rowspan="2" hidden>Nama</th>
                  <th colspan="2" class="text-center">Aktual</th>
                  <th colspan="2" class="text-center">Normalisasi</th>
                  <th rowspan="2">Hasil IMT</th>
                  <th colspan="4" class="text-center">Cluster</th>
                  <th rowspan="2">Hasil Cluster</th>
                </tr>
                <tr>
                  <th>Tinggi Badan (cm)</th>
                  <th>Berat Badan (kg)</th>
                  <th>Tinggi Badan</th>
                  <th>Berat Badan</th>
                  <?php foreach ($indexIMT as $key => $value) : ?>
                    <td><?= $value['nama'] ?></td>
                  <?php endforeach ?>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 0;
                $query = mysqli_query($conn, "SELECT * from isi_jawaban group by session_key order by created_at desc");
                foreach ($query as $row) : $no++;
                  $user = mysqli_fetch_array(mysqli_query($conn, "SELECT * from users where id = $row[id_user]"));
                  $active = $row['session_key'] == $_GET['key'] ? 'active' : '';
                  $json = json_decode($row['info'], true);
                  $norm[$row['session_key']]['tb'] = ($json['tb'] - $point['tb']['min']) / ($point['tb']['range']);
                  $norm[$row['session_key']]['bb'] = ($json['bb'] - $point['bb']['min']) / ($point['bb']['range']);
                  // $IMT[$row['session_key']] = $json['bb']/pow($json['tb']/100,2);
                  // $data['tb'][] = $json['tb'];
                  // $data['bb'][] = $json['bb'];
                ?>
                  <tr class="<?= $active ?>">
                    <td><?= $no ?></td>
                    <td hidden><?= $user['nama'] ?></td>
                    <td><?= $json['tb'] ?></td>
                    <td><?= $json['bb'] ?></td>
                    <td><?= $norm[$row['session_key']]['tb'] ?></td>
                    <td><?= $norm[$row['session_key']]['bb'] ?></td>
                    <td title="IMT: <?= round($IMT[$row['session_key']], 2) ?>"><?= IMT($IMT[$row['session_key']]) ?></td>
                    <?php foreach ($indexIMT as $key => $value) :
                      $stb = ($norm[$row['session_key']]['tb'] - $value['tb']);
                      $sbb = ($norm[$row['session_key']]['bb'] - $value['bb']);
                      $stb = $stb < 0 ? ($stb * -1) : $stb;
                      $sbb = $sbb < 0 ? ($sbb * -1) : $sbb;
                      $val[$row['session_key']][] = $stb + $sbb;
                    endforeach; ?>
                    <?php foreach ($indexIMT as $key => $value) :
                      $stb = ($norm[$row['session_key']]['tb'] - $value['tb']);
                      $sbb = ($norm[$row['session_key']]['bb'] - $value['bb']);
                      $stb = $stb < 0 ? round($stb * -1, 6) : round($stb, 6);
                      $sbb = $sbb < 0 ? round($sbb * -1, 6) : round($sbb, 6);
                    ?>
                      <td title="Total Jarak <?php echo $stb . " - " . $sbb . " = " . ($stb + $sbb) ?>">
                        <center>
                          <?php
                          if ($key == array_keys($val[$row['session_key']], min($val[$row['session_key']]))[0]) {
                            echo '<i class="fa fa-check"></i>';
                            $result['index'][$row['id_user']] = $value['index'];
                            $result['count'][$value['index']]++;
                            $thuis[$row['id_soal']][$row['id_jawaban']][$value['index']] = true;
                            // $thuis[$row['id_soal']][$row['id_jawaban']] = $value['index'];
                          }
                          // echo $key == array_keys($val[$row['session_key']], min($val[$row['session_key']]))[0] ? '<i class="fa fa-check"></i>':'';
                          ?>
                        </center>
                      </td>
                    <?php endforeach ?>
                    <td>
                      <?php
                      echo $indexIMT[$result['index'][$user['id']]]['nama'] ?>
                    </td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  <?php endif ?>
  <div class="col-sm-12 mb-5">
    <div class="card">
      <div class="card-header">
        <h3>
          <b class="text-primary">Soal</b>
        </h3>
      </div>
      <div class="card-body pb-2">
        <div class="table-responsive p-0">
          <table class="table table-hover">
            <tbody>
              <?php
              $no = 0;
              $query = mysqli_query($conn, "SELECT * from isi_jawaban where session_key = '" . $_GET['key'] . "'");
              foreach ($query as $row) :
                $soal = mysqli_fetch_array(mysqli_query($conn, "SELECT * from soal where id = '" . $row['id_soal'] . "'"));
                $jawaban = mysqli_fetch_array(mysqli_query($conn, "SELECT * from jawaban where id = '" . $row['id_jawaban'] . "'"));
                $no++;
              ?>
                <tr>
                  <!-- <td><?php echo $no ?></td> -->
                  <td colspan="text-wrap" colspan="3">
                    <p>
                      <b>
                        <?php echo $soal['soal'] ?>
                      </b>
                    </p>
                    <p>
                      <?php echo $jawaban['jawaban'] ?>
                    </p>
                  </td>
                  <td>
                    (Score <?php echo $jawaban['bobot'] ?>)
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <div class="col-sm-12 mb-5">
    <div class="card">
      <div class="card-header">
        <h3>
          <b class="text-primary">Naive Bayes</b>
        </h3>
      </div>
      <div class="card-body pb-2">
        <?php
        $noso = 0;
        $soal = mysqli_query($conn, "SELECT * from soal order by id");
        foreach ($soal as $s) {
          $noso++;
          echo "<p><b>Soal " . $noso . ".</b> " . $s['soal'] . "</p>";
        ?>
          <div class="table-responsive p-0">
            <table class="table mb-5">
              <thead>
                <th>Jawaban</th>
                <?php foreach ($indexIMT as $key => $value) : ?>
                  <th><?= $value['nama'] ?></th>
                <?php endforeach ?>
                <th>Jumlah</th>
              </thead>
              <tbody>
                <?php
                $jawaban = mysqli_query($conn, "SELECT * from jawaban where id_soal = '" . $s['id'] . "' order by bobot");
                foreach ($jawaban as $j) :
                  // $countRow = 0;
                ?>
                  <tr>
                    <td><?php echo $j['jawaban'] ?></td>
                    <?php
                    foreach ($indexIMT as $key => $value) :
                      $count = 0;
                      $state = false;
                      $count_isi_jawaban = mysqli_query($conn, "SELECT * from isi_jawaban where id_soal = '" . $s['id'] . "' and id_jawaban = '" . $j['id'] . "'");
                      $isi_jawaban = mysqli_query($conn, "SELECT * from isi_jawaban where id_soal = '" . $s['id'] . "' and id_jawaban = '" . $j['id'] . "' group by session_key");
                      foreach ($isi_jawaban as $ij) {
                        if ($value['index'] == $result['index'][$ij['id_user']]) {
                          if ($detail['id_user'] == $ij['id_user']) {
                            $state = true;
                          }
                          $count++;
                        }
                      }
                      // echo $thuis[$s['id']][$j['id']][$value['index']];
                      // echo $thuis[$s['id']][$j['id']];
                      // echo "-";
                      // echo $value['index'];
                      // $detail['id_user']
                      // $active = $thuis[$s['id']][$j['id']][$value['index']] ? 'background-color: #cb0d9e;color: white;':'';
                      if ($state) {
                        $result['naive']['num'][$noso]     = $count / $result['count'][$value['index']];
                        $result['naive']['string'][$noso]  = $count . "/" . $result['count'][$value['index']];
                      }
                      $countRow[$s['id']][$j['id']] += $count;
                      $countCol[$s['id']][$value['index']] = $result['count'][$value['index']];
                      $active = $state ? 'background-color: #cb0d9e;color: white;' : '';
                    ?>
                      <td width="20%" style="<?php echo $active; ?>">
                        <?php
                        echo $count . "/" . $result['count'][$value['index']];
                        // echo $result['naive']['string'][$noso];
                        ?>
                      </td>
                    <?php endforeach ?>
                    <td style="background-color: #f7daf0"><?php echo $countRow[$s['id']][$j['id']] . "/" . $jml_resp ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
              <tfoot>
                <tr>
                  <td></td>
                  <?php
                  foreach ($indexIMT as $key => $value) :
                  ?>
                    <td style="background-color: #f7daf0">
                      <?php
                      echo $countCol[$s['id']][$value['index']] . "/" . $jml_resp;
                      ?>
                    </td>
                  <?php endforeach ?>
                </tr>
              </tfoot>
            </table>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>
  <div class="col-sm-12 mb-5">
    <div class="card">
      <div class="card-body pb-2">
        <div class="table-responsive">
          <table class="table">
            <thead>
              <th>Index</th>
              <?php
              for ($i = 1; $i <= count($result['naive']['num']); $i++) {
              ?>
                <th><?php echo "Soal " . $i ?></th>
              <?php
              }
              ?>
              <th>Probabilitas</th>
            </thead>
            <tbody>
              <tr hidden>
                <td>Pecahan</td>
                <?php
                $sum = 1;
                for ($i = 1; $i <= count($result['naive']['num']); $i++) {
                  $sum *= $result['naive']['num'][$i];
                ?>
                  <td title="<?php echo $result['naive']['num'][$i] ?>">
                    <?php echo $result['naive']['string'][$i] ?>
                  </td>
                <?php
                }
                ?>
                <td title="<?php echo $sum ?>">
                  <b>
                    <?php echo ($sum * 100) . "%" ?>
                  </b>
                </td>
              </tr>
              <tr>
                <td>Desimal</td>
                <?php
                $sum = 1;
                for ($i = 1; $i <= count($result['naive']['num']); $i++) {
                  $sum *= $result['naive']['num'][$i];
                ?>
                  <td title="<?php echo $result['naive']['string'][$i] ?>">
                    <?php echo $result['naive']['num'][$i] ?>
                  </td>
                <?php
                }
                ?>
                <td title="<?php echo $sum ?>">
                  <b>
                    <?php echo ($sum * 100) . "%" ?>
                  </b>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>