<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Users.php";

	$obj = new users();

	$data = array(
				$_POST['userId'],
			    $_POST['uName'],
			    $_POST['uLastname'],
			    $_POST['uUser']
			);

	echo $obj->updateUser($data);
 ?>