<?php

date_default_timezone_set('Asia/Jakarta');
$conn = mysqli_connect("localhost", "root", "", "dompetyatim");

// ip
function get_client_ip()
{
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if (getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if (getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if (getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if (getenv('HTTP_FORWARDED'))
		$ipaddress = getenv('HTTP_FORWARDED');
	else if (getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
	return $ipaddress;
}

function convertDateDBtoIndo($string)
{
	// contoh : 2019-01-30

	$bulanIndo = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

	$tanggal 	= explode("-", $string)[2];
	$bulan 		= explode("-", $string)[1];
	$tahun 		= explode("-", $string)[0];

	return $tanggal . " " . $bulanIndo[abs($bulan)] . " " . $tahun;
}

function RemoveSpecialChar($target)
{

	// Using str_replace() function 
	// to replace the word 
	$res = str_replace(array("#", "."), ' ', $target);


	// Returning the result 
	return $res;
}

function RemoveSpecialChar2($desk_acak)
{

	// Using str_replace() function 
	// to replace the word 
	$res = str_replace(array("#", "'"), ' ', $desk_acak);


	// Returning the result 
	return $res;
}

function resizeImage($resourceType,$image_width,$image_height) {
    $resizeWidth = 225;
    $resizeHeight = 225;
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

function upload() {
	$file 		= $_FILES['gambar']['name'];
	$ukuran 	= $_FILES['gambar']['size'];
	$error 		= $_FILES['gambar']['error'];
	$tmpName 	= $_FILES['gambar']['tmp_name'];

	$uploadPath = '../img/profil/';

	
	// cek gambat

	if ($error === 4) {
		return false;
	}

	// cek gambar/bukan
	$ekstensigambarvalid = ['jpg', 'jpeg', 'png'];
	$ekstensigambar = explode('.', $file); 
	$ekstensigambar = strtolower(end($ekstensigambar));

	if (!in_array($ekstensigambar, $ekstensigambarvalid) ) {
		echo "<script>

		alert('yang di upload bukan gambar');

			</script>";
			return false;
		
	}

	// cek ukuran terlalu bessar
	if ($ukuran>10000000) {
		echo "<script>

		alert('ukuran terlalu besar');

			</script>";
			return false;
		
	}

	$sourceProperties = getimagesize($tmpName);
	$uploadImageType = $sourceProperties[2];
	$sourceImageWidth = $sourceProperties[0];
	$sourceImageHeight = $sourceProperties[1];

	// generate nama batu gambar
	$namagambarbaru = uniqid();
	$namagambarbaru .='.';
	$namagambarbaru .= $ekstensigambar;

	switch ($uploadImageType) {
		case IMAGETYPE_JPEG:
			$resourceType = imagecreatefromjpeg($tmpName); 
			$imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
			imagejpeg($imageLayer,$uploadPath."thump_".$namagambarbaru);
			break;

		case IMAGETYPE_JPG:
			$resourceType = imagecreatefromjpg($tmpName); 
			$imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
			imagejpg($imageLayer,$uploadPath."thump_".$namagambarbaru);
			break;

		case IMAGETYPE_PNG:
			$resourceType = imagecreatefrompng($tmpName); 
			$imageLayer = resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight);
			imagepng($imageLayer,$uploadPath."thump_".$namagambarbaru);
			break;
	}
	
	// die(var_dump($sourceImageHeight));

	 // siap di upload
	move_uploaded_file($tmpName,  $uploadPath . $namagambarbaru);
	

	return $namagambarbaru;

}

function buat_campaign($data)
{
	global $conn;

	$nama     	    = htmlspecialchars($data["nama"]);
	$judul     	    = htmlspecialchars($data["judul"]);
	$link_donasi    = htmlspecialchars($data["link_donasi"]);
	$dibuat   	    = date("Y-m-d");
	$periode     	= htmlspecialchars($data["periode"]);
	$donasi	        = htmlspecialchars($data["donasi"]);
	$desk_acak	    = htmlspecialchars($data["deskripsi"]);
	$deskripsi 	    = RemoveSpecialChar2($desk_acak);
	$target 	    = htmlspecialchars($data["target"]);
	$target1 	    = RemoveSpecialChar($target);
	$new_target	    = str_replace(' ', '', $target1);
	$ip     	    = get_client_ip();
	$date   	    = date("Y-m-d H:i:s");

    $query = mysqli_query($conn, "SELECT judul FROM campaign WHERE judul = '$judul'  ");

	if (mysqli_fetch_assoc($query)) {

		echo "<script>
			alert('Judul campaign sudah ada');
		</script>";

		return false;
	}

    $query2 = mysqli_query($conn, "SELECT judul FROM campaign WHERE link = '$link_donasi'  ");

	if (mysqli_fetch_assoc($query2)) {

		echo "<script>
			alert('Link campaign sudah ada');
		</script>";

		return false;
	}


	$result2 = mysqli_query($conn, "INSERT INTO log_aktivity VALUES('', '$nama', '$ip',
	'$date', '$nama telah membuat campaign baru dengan judul $judul')");

	// input data ke database
	$result = mysqli_query($conn, "INSERT INTO campaign VALUES('', '$link_donasi', '$nama', '$judul', '$donasi', '0', '$new_target', '$dibuat','$periode', '$deskripsi', '', '', 'Pending')");

	// die(var_dump($result));
	return mysqli_affected_rows($conn);

}


function konfirmasi_campaign($data) {
	
	global $conn;
	
	$link 		= htmlspecialchars($data["link"]);
	$dibuat   	= date("Y-m-d");
	$periode 	= htmlspecialchars($data["periode"]);
	$judul 		= htmlspecialchars($data["judul"	]);
	$desk_acak 	= htmlspecialchars($data["deskripsi"]);
	$deskripsi 	= RemoveSpecialChar2($desk_acak);
	$ip     	= get_client_ip();
	$date   	= date("Y-m-d H:i:s");

	// link campaign
	$halaman 	= "<?php include 'models/detail_campaign.php'; ?>";
$link_donasi = $link.".php";

// link donasi
$untukdonasi = "<?php include '../models/donasi.php' ?>";

$file = fopen("../../new_dompet/".$link_donasi,"w");
echo fwrite($file,$halaman);

$file2 = fopen("../../new_dompet/donasi/".$link_donasi,"w");
echo fwrite($file2,$untukdonasi);

$result2 = mysqli_query($conn, "INSERT INTO log_aktivity VALUES('', '$_SESSION[nama]', '$ip',
'$date', '$_SESSION[nama] telah Mengkonfirmasi campaign baru dengan judul $judul')");

// input data ke database
$update = mysqli_query($conn,
"UPDATE `campaign` SET
`dibuat` = '$dibuat',
`berakhir` = '$periode',
`ajakan` = '$deskripsi',
`status` = 'Berlangsung'
WHERE link = '$link' ");

// die(var_dump($result2));
return mysqli_affected_rows($conn);

}

function konfirmasi_donasi ($data) {

global $conn;

$key = htmlspecialchars($data["key"]);
$unik = htmlspecialchars($data["unik"]);
$bank = htmlspecialchars($data["bank"]);
$view_name = htmlspecialchars($data["view_name"]);
$jenis = htmlspecialchars($data["jenis"]);
$donasi = htmlspecialchars($data["donasi"]);
$donasi1 = RemoveSpecialChar($donasi);
$new_donasi = str_replace(' ', '', $donasi1);
$ip = get_client_ip();
$date = date("Y-m-d H:i:s");

// die(var_dump($view_name));
$result2 = mysqli_query($conn, "INSERT INTO log_aktivity VALUES('', '$_SESSION[nama]', '$ip',
'$date', '$_SESSION[nama] telah Mengkonfirmasi donasi yang masuk dari campaign $jenis')");

$update = mysqli_query($conn, "UPDATE `donasi` SET
`nama_tampil` = '$view_name',
`jumlah_donasi` = '$new_donasi',
`via` = '$bank',
`status` ='Terkonfirmasi'
WHERE id = $key");

$q = mysqli_query($conn, "SELECT * FROM donasi WHERE jenis = '$jenis' AND status = 'Terkonfirmasi' ");

$i = 1;
$sql = $q;
while($r = mysqli_fetch_array($sql))
{
$short_date = date("Y-m-d", strtotime($r['dibuat']));
$convert = convertDateDBtoIndo($short_date);
$bulan = substr($convert, 3, -5);
$d_anggaran = $r['jumlah_donasi'];
$i++;
$total_anggaran[$i] = $d_anggaran;

$hasil_anggaran = array_sum($total_anggaran);

}

$update2 = mysqli_query($conn, "UPDATE `campaign` SET
`terkumpul` = '$hasil_anggaran'
WHERE `judul` = '$jenis' ");

// die(var_dump($update2));

$tgl_unik = date("Y-m-d", strtotime($unik));
$key_unik = substr($tgl_unik, 5, -3);
// die(var_dump($key_unik));

$k = mysqli_query($conn, "SELECT * FROM donasi WHERE MONTH(dibuat) = '$key_unik' AND status = 'Terkonfirmasi' ");
$sum_donatur = $k->num_rows;
$sql_data = $k;
while($data_list = mysqli_fetch_array($sql_data))
{

$d_donasi = $data_list['jumlah_donasi'];
$i++;
$total_donasi[$i] = $d_donasi;

$hasil_donasi = array_sum($total_donasi);

}

$update3 = mysqli_query($conn, "UPDATE `data_dompet` SET
`donatur` = '$sum_donatur',
`donasi_terkumpul` = '$hasil_donasi'
WHERE `bulan` = '$bulan' ");

// die(var_dump($bulan));

return mysqli_affected_rows($conn);

}

// update campaign
function update_campaign($data)
{
global $conn;

$link = $data["link"];
$judul = htmlspecialchars($data["judul"]);
$fix_judul = htmlspecialchars($data["fix_judul"]);
$deskripsi = htmlspecialchars($data["deskripsi"]);
$ip = get_client_ip();
$date = date("Y-m-d H:i:s");

$input = mysqli_query($conn, "INSERT INTO update_campaign VALUES('', '$link', '$judul', '$date', '$deskripsi')");

// die(var_dump($view_name));
$result2 = mysqli_query($conn, "INSERT INTO log_aktivity VALUES('', '$_SESSION[nama]', '$ip',
'$date', '$_SESSION[nama] telah Mengupdate Campaign $fix_judul')");

// die(var_dump($input));

return mysqli_affected_rows($conn);

}


?>