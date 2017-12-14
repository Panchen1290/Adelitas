<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Categories.php";

	$data = array($_POST['categoryid'], $_POST['uCategory']);

	$obj = new categories();

	echo $obj->updateCategory($data);

 ?>