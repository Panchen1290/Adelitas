<?php 
	require_once "classes/Connection.php";
	$obj = new connect();
	$connection=$obj->connection();

	$sql="SELECT * from users where user='admin'";
	$result=mysqli_query($connection,$sql);
	$validate = 0;
	if (mysqli_num_rows($result) > 0) {
		$validate = 1;
	}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login de usuario</title>
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
				<div class="panel panel-primary">
					<div class="panel panel-heading">
						Ventas e inventario Adelitas
					</div>
					<div class="panel panel-body">
						<p>
							<img src="img/login_logo.jpg" height="200px" width="325px">
						</p>
						<form id="frmLogin">
							<label>Usuario</label>
							<input type="text" class="form-control input-sm" name="user" id="user">
							<label>Password</label>
							<input type="Password" class="form-control input-sm" name="password" id="password">
							<p></p>
							<span class="btn btn-primary btn-sm" id="login">Entrar</span>
							<?php if (!$validate): ?>
							 <a href="register.php" class="btn btn-danger btn-sm">Registrar</a>
							 <?php endif; ?>
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
		$('#login').click(function() {

			empty = validateFormEmpty('frmLogin');

			if (empty > 0) {
				alert("Se debe llenar todos los campos");
				return false;
			}

			data=$('#frmLogin').serialize();
			$.ajax({
				type:"POST",
				data:data, 
				url:"processes/regLogin/loginUser.php",
				success:function(r) {
					if (r == 1) {
						window.location="views/init.php";
					} else {
						alert("No se pudo acceder =c");
					}
				}
			});
		});
	});
</script>