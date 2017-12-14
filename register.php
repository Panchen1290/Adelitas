<?php 
	require_once "classes/Connection.php";
	$obj = new connect();
	$connection=$obj->connection();

	$sql="SELECT * from users where user='admin'";
	$result=mysqli_query($connection,$sql);
	$validate = 0;
	if (mysqli_num_rows($result) > 0) {
		header("location:index.php");
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registrar usuario</title>
	<link rel="stylesheet" type="text/css" href="libraries/bootstrap/css/bootstrap.css">
	<script src="libraries/jquery-3.2.1.min.js"></script>
	<script src="js/functions.js"></script>

</head>
<body style="background-color: black">
	<br><br><br>
	<div class="container">
		<div class="row">
			<div class="col-sm-4"></div>
			<div class="col-sm-4">
				<div class="panel panel-danger">
					<div class="panel panel-heading">
						Registrar administrador
					</div>
					<div class="panel panel-body">
						<form id="frmRegister">
							<label>Nombre</label>
							<input type="text" class="form-control input-sm" name="name" id="name">
							<label>Apellido</label>
							<input type="text" class="form-control input-sm" name="lastname" id="lastname">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="user" id="user">
							<label>Password</label>
							<input type="text" class="form-control input-sm" name="password" id="password">
							<p></p>
							<span class="btn btn-primary" id="register">Registrar</span>
							<a href="index.php" class="btn btn-default">Regresar al Login</a>
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-4"></div>
		</div>
	</div>
	
</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#register').click(function() {

			empty = validateFormEmpty('frmRegister');

			if (empty > 0) {
				alert("Se debe llenar todos los campos");
				return false;
			}

			data=$('#frmRegister').serialize();
			$.ajax({
				type:"POST",
				data:data, 
				url:"processes/regLogin/registerUser.php",
				success:function(r) {
					if (r == 1) {
						alert("Agregado con exito!");
					} else {
						alert("Fallo al agregar =c");
					}
				}
			});
		});
	});
</script>