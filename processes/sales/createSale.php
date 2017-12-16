<?php 
	session_start();
	require_once "../../classes/Connection.php";
	require_once "../../classes/Sales.php";

	$obj = new sales();

	if (count($_SESSION['tempSellTable']) == 0) {
		echo 0;
	} else {
		$result = $obj->createSale();
		unset($_SESSION['tempSellTable']);
		echo $result;
	}
 ?>