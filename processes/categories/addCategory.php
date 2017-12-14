<?php 
	session_start();
	require_once "../../classes/Connection.php";
	require_once "../../classes/Categories.php";

	$userid=$_SESSION['userid'];
	$category=$_POST['category'];
	$date=date('Y-m-d');

	$data=array($userid, $category, $date);

	$obj = new Categories();
	echo $obj->addCategory($data);
 ?>