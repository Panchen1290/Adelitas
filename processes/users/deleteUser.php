<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Users.php";

	$id=$_POST['userid'];

	$obj = new users();
	echo $obj->deleteUser($id);
 ?>