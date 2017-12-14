<?php 
	session_start();
	$userid=$_SESSION['userid'];
	require_once "../../classes/Connection.php";
	require_once "../../classes/Products.php";

	$obj=new products();

	$data=array();

	$imgName=$_FILES['image']['name'];
	$storagePath=$_FILES['image']['tmp_name'];
	$file='../../files/';
	$finalPath=$file.$imgName;

	$imgData=array($imgName, $finalPath);

	if (move_uploaded_file($storagePath, $finalPath)) {
		$imgid=$obj->addImage($imgData);

		if ($imgid > 0) {
			$data[0]=$imgid;
			$data[1]=$userid;
			$data[2]=$_POST['categorySelect'];
			$data[3]=$_POST['barcode'];
			$data[4]=$_POST['name'];
			$data[5]=$_POST['description'];
			$data[6]=$_POST['amount'];
			$data[7]=$_POST['price'];
			echo $obj->addProduct($data);
		} else {
			echo 0;
		}
	}
 ?>