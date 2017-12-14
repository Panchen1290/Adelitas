<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Categories.php";

	$id=$_POST['categoryid'];

	$obj = new categories();
	echo $obj->deleteCategory($id);
 ?>