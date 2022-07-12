<?php 
include '../../config/koneksi.php';
$user   = $_SESSION['id'];
$now    = date('Y-m-d H:i:s');
$table  = 'soal';
$module = $_GET['module'];
$act    = $_GET['act'];
if($act == 'create'){
    $sql="INSERT INTO ".$table." (soal,bobot)
    VALUES ('".$_POST['soal']."','".$_POST['bobot']."')";
    $query = mysqli_query($conn,$sql);
    $_SESSION['flash']['class']='alert alert-success';
    $_SESSION['flash']['label']='Penambahan '.$_GET['module'].' Berhasil';
    $_SESSION['flash']['icon']='fa fa-check';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'edit'){
    $sql="UPDATE ".$table." SET 
    soal        = '".$_POST['soal']."',
    bobot       = '".$_POST['bobot']."'
    WHERE id = '".$_POST['id']."'";
    $query = mysqli_query($conn, $sql);
    $_SESSION['flash']['class']='alert alert-success';
    $_SESSION['flash']['label']='Pengubahan '.$_GET['module'].' Berhasil';
    $_SESSION['flash']['icon']='fa fa-edit';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'delete'){
    $query = mysqli_query($conn, "DELETE FROM ".$table." WHERE id = '".$_GET['id']."'");
    $_SESSION['flash']['class']='alert alert-danger';
    $_SESSION['flash']['label']='Penghapusan '.$_GET['module'].' Berhasil';
    $_SESSION['flash']['icon']='fa fa-trash';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'active'){
    $sql="UPDATE ".$table." SET aktif = 'Y' where id = '".$_GET['id']."'";
    $query = mysqli_query($conn, $sql);
    $_SESSION['flash']['class']='alert alert-success';
    $_SESSION['flash']['label']='Aktivasi Akun Berhasil';
    $_SESSION['flash']['icon']='fa fa-check';
    header('Location: ../../media.php?module='.$module);
}else if($act == 'inactive'){
    $sql="UPDATE ".$table." SET aktif = 'N' where id = '".$_GET['id']."'";
    $query = mysqli_query($conn, $sql);
    $_SESSION['flash']['class']='alert alert-danger';
    $_SESSION['flash']['label']='Akun Telah Disuspend';
    $_SESSION['flash']['icon']='fa fa-ban';
    header('Location: ../../media.php?module='.$module);
}
?>