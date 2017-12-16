<?php 
	session_start();

	$index=$_POST['ind'];
	unset($_SESSION['tempSellTable'][$index]);

	$data = array_values($_SESSION['tempSellTable']);

	unset($_SESSION['tempSellTable']);
	$_SESSION['tempSellTable']=$data;
 ?>