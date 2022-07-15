<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Dataset</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="row">
        <div class="col-sm-12">
            <?php
            include_once '../../../config/koneksi.php';

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
            <script>
                window.print();

                function back() {
                    history.back();
                }
                setTimeout(back, 3000);
            </script>
</body>

</html>