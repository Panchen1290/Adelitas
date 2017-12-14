<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Products.php";

	$obj = new products();

	$prodid=$_POST['productid'];
	echo $obj->deleteProduct($prodid);
 ?>