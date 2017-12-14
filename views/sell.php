<?php 
	session_start();
	if(isset($_SESSION['user'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Vender</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
	<div class="container">
		<h1>Vender</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmSellProduct">
						<label>Selecciona Cliente</label>
						<select class="form-control input-sm" name="clientSelect" id="clientSelect">
							<option value="A">Seleccionar</option>
						</select>
						<label>Codigo de Producto</label>
						<input class="form-control input-sm" name="" id=""></input>
						<label>Selecciona Producto</label>
						<select class="form-control input-sm" name="productSelect" id="productSelect">
							<option value="A">Seleccionar</option>
						</select> 
						<label>Cantidad</label>
						<input type="text" class="form-control input-sm" name="" id="">
						<p></p>
						<span class="btn btn-primary" id="btnAddSale">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="loadSellTable"></div>
				</div>
			</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#clientSelect').select2();
		$('#productSelect').select2();

		$('#loadSellTable').load("sales/sellTable.php");

		$('#btnAddSale').click(function() {

			empty = validateFormEmpty('frmSellProduct');

			if (empty > 0) {
				alertify.alert("Se debe llenar todos los campos");
				return false;
			}

			data=$('#frmSellProduct').serialize();
			$.ajax({
				type:"POST",
				data:data, 
				url:"../processes/products/addProducts.php",
				success:function(r) {
					if (r == 1) {
						$('#loadProductsTable').load("products/productsTable.php");
						alertify.success("Agregado con exito!");
					} else {
						alertify.error("No se pudo agregar");
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