<?php 
	session_start();
	require_once "../../classes/Connection.php";
	require_once "../../classes/Users.php";

	$obj= new users();

	$data=array($_POST['user'], $_POST['password']);

	echo $obj->loginUser($data);
 ?>