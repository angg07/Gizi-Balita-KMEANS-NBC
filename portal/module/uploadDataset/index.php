<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>

    <div class="row">
        <div class="col-sm-12">
            <?php include('aksi.php') ?>
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlFile1">Masukkan Dataset</label>
                    <input type="file" class="form-control-file" id="formFile" name="filexls">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-primary" value="Upload File">
                </div>
            </form>
            <?php
            include_once '../../config/koneksi.php';

            $query = mysqli_query($conn, "SELECT * FROM dataset");
            ?>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table display" id="datatables">
                                <tr>
                                    <th>No</th>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Tinggi Badan</th>
                                    <th>Berat Badan</th>
                                </tr>
                                <?php if (mysqli_num_rows($query) > 0) { ?>
                                    <?php
                                    $no = 1;
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo $data["nik"]; ?></td>
                                            <td><?php echo $data["nama"]; ?></td>
                                            <td><?php echo $data["tb"]; ?></td>
                                            <td><?php echo $data["bb"]; ?></td>
                                        </tr>
                                    <?php $no++;
                                    } ?>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>