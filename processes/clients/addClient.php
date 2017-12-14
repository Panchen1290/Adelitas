<?php 
	session_start();
	require_once "../../classes/Connection.php";
	require_once "../../classes/Clients.php";

	$obj = new clients();

	$data = array(
				$_POST['name'],
				$_POST['lastname'],
				$_POST['code'],
				$_POST['tin']
			);

	echo $obj->addClient($data);

?>