<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Users.php";

	$obj= new users();

	$pass=sha1($_POST['password']);

	$data=array(
		$_POST['name'],
		$_POST['lastname'],
		$_POST['user'],
		$pass
	);

	echo $obj->registerUser($data);
?>