<?php 
	session_start();
	require_once "../../classes/Connection.php";
	$c = new connect();
	$connection = $c->connection();


	$clientid=$_POST['clientSelect'];
	$barcode=$_POST['barcode'];
	$productid=$_POST['productSelect'];
	$amount=$_POST['amount'];
	$description=$_POST['description'];
	$price=$_POST['price'];

	$sql="SELECT name, lastname from clients where id_client='$clientid'";
	$result = mysqli_query($connection, $sql);
	$client = mysqli_fetch_row($result);
	$clientName = $client[1]." ".$client[0];

	$sql="SELECT name from products where id_product='$productid'";
	$result = mysqli_query($connection, $sql);
	$productName = mysqli_fetch_row($result)[0];

	$sql="SELECT img.filePath from images as img inner join products as prod on prod.id_image=img.id_image where prod.id_product='$productid'";
	$result = mysqli_query($connection, $sql);
	$imagePath = mysqli_fetch_row($result)[0];

	$product = $productid."||".
				$imagePath."||".
				$productName."||".
				$amount."||".
				$price."||".
				$clientName."||".
				$clientid;

	$_SESSION['tempSellTable'][]=$product;
?>