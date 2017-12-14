<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Products.php";

	$obj = new products();

	$prodid=$_POST['prodid'];

	echo json_encode($obj->getProductData($prodid));
 ?>