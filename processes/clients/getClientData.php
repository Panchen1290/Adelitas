<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Clients.php";

	$obj = new clients();

	echo json_encode($obj->getClientData($_POST['clientid']));
 ?>