<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Users.php";

	$obj = new users();

	echo json_encode($obj->getUserData($_POST['userid']));
 ?>