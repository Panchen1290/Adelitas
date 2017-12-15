<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Clients.php";

	$id=$_POST['clientid'];

	$obj = new clients();
	echo $obj->deleteClient($id);
 ?>