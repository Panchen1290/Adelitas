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

	<!-- Modal -->
	<div class="modal fade" id="updateClientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Actualizar Cliente</h4>
				</div>
				<div class="modal-body">
				   	<form id="uClientsForm">
						<input type="text" hidden="" name="clientid" id="clientid">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" name="uName" id="uName">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" name="uLastname" id="uLastname">
						<label>Codigo</label>
						<input type="text" class="form-control input-sm" name="uCode" id="uCode">
						<label>NIT</label>
						<input type="text" class="form-control input-sm" name="uTin" id="uTin">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="btnUpdateClient">Actualizar Cliente</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	function addClientData(clientid) {
		$.ajax({
			type:"POST",
			data:"clientid=" + clientid, 
			url:"../processes/clients/getClientData.php",
			success:function(r) {
				data=jQuery.parseJSON(r);
				$('#clientid').val(data['id_client']);
				$('#uName').val(data['name']);
				$('#uLastname').val(data['lastname']);
				$('#uCode').val(data['code']);
				$('#uTin').val(data['tin']);
			}
		});
	}

	function deleteClient(clientId) {
		alertify.confirm('Desea eliminar este cliente?', function() {
			$.ajax({
				type:"POST",
				data:"clientid=" + clientId,
				url:"../processes/clients/deleteClient.php",
				success:function(r) {
					if (r == 1) {
						$('#loadClientsTable').load("clients/clientsTable.php");
						alertify.success("Eliminado con exito");
					} else {
						alertify.error("No se pudo eliminar");
					}
				}
			});
		}, function() {
			alertify.error('Cancelado');
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#btnUpdateClient').click(function() {
			data=$('#uClientsForm').serialize();
			$.ajax({
				type:"POST",
				data:data,
				url:"../processes/clients/updateClient.php",
				success:function(r) {
					if (r == 1) {
						$('#clientsForm')[0].reset();
						$('#loadClientsTable').load("clients/clientsTable.php");
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