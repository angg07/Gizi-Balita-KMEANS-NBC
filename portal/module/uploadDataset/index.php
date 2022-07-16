    <div class="row">
        <div class="col-sm-12">
            <?php
            include_once 'aksi.php'
            ?>
            <div class="row">
                <div class="col-sm-6">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <h4 for="exampleFormControlFile1">Masukkan Dataset</h4><br>
                            <input type="file" class="form-control" id="formFile" name="filexls">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-success" value="Upload File">
                            <input type="submit" name="deleteDataset" class="btn btn-danger
                            " value="Delete Dataset">
                        </div>
                    </form>
                </div>
            </div>

            <?php
            include_once '../../config/koneksi.php';

            $query = mysqli_query($conn, "SELECT * FROM dataset");
            ?>
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
                                                <td><?php echo $data["tb"]; ?></td>
                                                <td><?php echo $data["bb"]; ?></td>
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