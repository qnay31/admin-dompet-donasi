<?php
require "../../function.php";

$image = $_POST['image'];

list($type, $image) = explode(';',$image);
list(, $image) = explode(',',$image);

$image = base64_decode($image);
$image_name = time().'.jpeg';
file_put_contents('../../assets/images/cover-campaign/'.$image_name, $image);

$query 	= mysqli_query($conn, "SELECT link FROM campaign ORDER BY `id` DESC");
$data 	= mysqli_fetch_assoc($query);
$link	= $data["link"];

$update = mysqli_query($conn, 
		"UPDATE `campaign` SET
		`foto` 		= '$image_name'
		WHERE link	= '$link' ");

    // die(var_dump($update));

echo 'successfully uploaded';

?>