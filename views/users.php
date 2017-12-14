<?php 
	session_start();
	if(isset($_SESSION['user']) and $_SESSION['user'] =='admin') {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Usuarios</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
	<div class="container">
		<h1>Administrar Usuarios</h1>
		<div class="row">
			<div class="col-sm-4">
				<form id="registerForm">
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
				</form>
			</div>
			<div class="col-sm-8">
				<div id="loadUsersTable"></div>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div class="modal fade" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Actualizar Usuario</h4>
				</div>
				<div class="modal-body">
				    <form id="uRegisterForm">
				    	<input type="text" hidden="" name="userId" id="userId">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" name="uName" id="uName">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" name="uLastname" id="uLastname">
						<label>Usuario</label>
						<input type="text" class="form-control input-sm" name="uUser" id="uUser">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="btnUpdateUser">Actualizar Usuario</button>
				</div>
			</div>
		</div>
	</div>

</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#btnUpdateUser').click(function() {
			data=$('#uRegisterForm').serialize();
			$.ajax({
				type:"POST",
				data:data, 
				url:"../processes/users/updateUser.php",
				success:function(r) {
					if (r == 1) {
						$('#loadUsersTable').load("users/usersTable.php");
						alertify.success("Actualizado con exito!");
					} else {
						alertify.error("Fallo al actualizar");
					}
				}
			});
		});
	});
</script>

<script type="text/javascript">
	function addUserData(userid) {
		$.ajax({
			type:"POST",
			data:"userid=" + userid, 
			url:"../processes/users/getUserData.php",
			success:function(r) {
				data=jQuery.parseJSON(r);
				$('#userId').val(data['id_user']);
				$('#uName').val(data['name']);
				$('#uLastname').val(data['lastname']);
				$('#uUser').val(data['user']);
			}
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {

		$('#loadUsersTable').load("users/usersTable.php");

		$('#register').click(function() {

			empty = validateFormEmpty('registerForm');

			if (empty > 0) {
				alertify.alert("Se debe llenar todos los campos");
				return false;
			}

			data=$('#registerForm').serialize();
			$.ajax({
				type:"POST",
				data:data, 
				url:"../processes/regLogin/registerUser.php",
				success:function(r) {
					if (r == 1) {
						$('#registerForm')[0].reset();
						$('#loadUsersTable').load("users/usersTable.php");
						alertify.success("Agregado con exito!");
					} else {
						alertify.error("Fallo al agregar");
					}
				}
			});
		});
	});
</script>

<?php 
	} else {
		header("location:../index.php");
	}
?>