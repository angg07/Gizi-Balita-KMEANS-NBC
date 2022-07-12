<div class="row">
  <div class="col-sm-12">
    <?php 
    if (isset($_SESSION['flash'])): ?>
      <div class="<?php echo $_SESSION['flash']['class']; ?> mt-3 mb-3 alert-dismissible fade show"> 
        <span class="text-white">
          <i class="<?php echo $_SESSION['flash']['icon'] ?>"></i> 
          <?php echo $_SESSION['flash']['label']; ?>  
        </span>
        <button class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
      </div>
    <?php endif ?>
  </div>
  <div class="col-sm-12">
    <div class="card">
      <!-- <div class="card-header">
        <a class="btn btn-primary" href="?module=<?php echo $_GET['module'];?>&act=create">Tambah <?php echo ucwords($_GET['module']) ?></a>
      </div> -->
      <div class="card-body px-0 pt-0 pb-2">
        <div class="table-responsive p-0">
          <table class="table display" id="datatables">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th class="d-print-none"></th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no=0;
              $query = mysqli_query($conn,"SELECT * from isi_jawaban group by session_key order by id desc");
              foreach ($query as $row): 
                $no++;
                $users = mysqli_fetch_array(mysqli_query($conn,"SELECT * from users where id = '".$row['id_user']."'"));

                ?>
                <tr>
                  <td><?php echo $no ?></td>
                  <td>
                    <a class="text-primary" data-toggle="tooltip" data-placement="top" title="Detail" href="?module=hasil_tes&act=detail&key=<?php echo $row['session_key']; ?>">
                      <b><?php echo $users['nama'] ?></b>
                    </a>
                  </td>
                  <td><?php echo explode(" ",$row['created_at'])[0] ?></td>
                  <td><?php echo explode(" ",$row['created_at'])[1] ?></td>
                  <td class="d-print-none text-right">
                    <a class="btn btn-secondary btn-xs" data-toggle="tooltip" data-placement="top" title="Detail"  href="?module=hasil_tes&act=detail&key=<?php echo $row['session_key']; ?>"><i class="fa fa-eye"></i></a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>