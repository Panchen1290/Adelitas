<?php 
	session_start();
	if(isset($_SESSION['user'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Clientes</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
	<div class="container">
		<h1>Clientes</h1>
		<div class="row">
			<div class="col-sm-4">
				<form id="clientsForm">
					<label>Nombre</label>
					<input type="text" class="form-control input-sm" name="name" id="name">
					<label>Apellido</label>
					<input type="text" class="form-control input-sm" name="lastname" id="lastname">
					<label>Codigo</label>
					<input type="text" class="form-control input-sm" name="code" id="code">
					<label>NIT</label>
					<input type="text" class="form-control input-sm" name="tin" id="tin">
					<p></p>
					<span class="btn btn-primary" id="btnAddClient">Agregar</span>
				</form>
			</div>
			<div class="col-sm-8">
				<div id="loadClientsTable"></div>
			</div>
		</div>
	</div>	
</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {

		$('#loadClientsTable').load("clients/clientsTable.php");

		$('#btnAddClient').click(function() {

			empty = validateFormEmpty('clientsForm');

			if (empty > 0) {
				alertify.alert("Se debe llenar todos los campos");
				return false;
			}

			data=$('#clientsForm').serialize();
			$.ajax({
				type:"POST",
				data:data,
				url:"../processes/clients/addClient.php",
				success:function(r) {
					if (r == 1) {
						$('#clientsForm')[0].reset();
						$('#loadClientsTable').load("clients/clientsTable.php");
						alertify.success("Agregado con exito!");
					} else {
						alertify.error("Fallo al agregar =c");
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