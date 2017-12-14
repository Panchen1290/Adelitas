<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Products.php";

	$obj = new products();

	$data = array(
			    $_POST['productId'],
			    $_POST['uCategorySelect'],
		    	$_POST['uBarcode'],
		    	$_POST['uName'],
		    	$_POST['uDescription'],
		    	$_POST['uAmount'],
		    	$_POST['uPrice']
			);

	echo $obj->updateProduct($data);
 ?>