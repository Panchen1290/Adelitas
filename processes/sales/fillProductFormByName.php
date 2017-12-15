<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Sales.php";

	$obj = new sales();

	echo json_encode($obj->getProductDataByName($_POST['productid']));
 ?>