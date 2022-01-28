<?php 
date_default_timezone_set('Asia/Jakarta');
session_start();

require 'function.php';

$date   = date("Y-m-d H:i:s");
$ip     = get_client_ip();

$q = mysqli_query($conn, "SELECT akun_pengurus.nama, list_divisi.posisi

FROM akun_pengurus
JOIN list_divisi ON list_divisi.id_pengurus = akun_pengurus.id_pengurus WHERE akun_pengurus.username = '$_SESSION[username]' ");

$data   = mysqli_fetch_array($q);

$query = mysqli_query($conn, "INSERT INTO log_aktivity VALUES('', '$_SESSION[nama]', '$data[posisi]', '$ip', '$date', '$_SESSION[nama] $data[posisi] Telah Logout')");
// die(var_dump($query));
session_start();
$SESSION = [];
session_destroy();
session_unset();

setcookie('id', '', time() - 3600);
setcookie('key', '', time() -3600);

header("Location: index.php");
exit;

 ?>