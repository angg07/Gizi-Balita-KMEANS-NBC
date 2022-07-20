<div class="row">
    <div class="col-sm-12">
        <?php
        include_once '../../config/koneksi.php';

        $query = mysqli_query($conn, "SELECT * FROM dataset WHERE jenisData='testing'");
        ?>
        <h4>Data Testing</h4><br>

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table" id="datatablesDataset">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" align="center">No</th>
                                    <th scope="col">NIK</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">TTL</th>
                                    <th scope="col">GOL. Darah</th>
                                    <th scope="col">Tinggi Badan</th>
                                    <th scope="col">Berat Badan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (mysqli_num_rows($query) > 0) { ?>
                                    <?php
                                    $no = 1;
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $no ?></td>
                                            <td><?php echo $data["nik"]; ?></td>
                                            <td><?php echo $data["nama"]; ?></td>
                                            <td><?php echo $data["tempatLahir"] . ", " . $data["tanggalLahir"]; ?></td>
                                            <td align="center"><?php echo $data["golDar"]; ?></td>
                                            <td align="right"><?php echo $data["tb"]; ?> Cm</td>
                                            <td align="right"><?php echo $data["bb"]; ?> Kg</td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>