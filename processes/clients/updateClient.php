<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Clients.php";

	$obj = new clients();

	$data = array(
				$_POST['clientid'],
				$_POST['uName'],
				$_POST['uLastname'],
				$_POST['uCode'],
				$_POST['uTin']
			);

	echo $obj->updateClient($data);
?>