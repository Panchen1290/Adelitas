<?php 
	session_start();
	if(isset($_SESSION['user'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Productos</title>
	<?php require_once "menu.php"; ?>
	<?php require_once "../classes/Connection.php";
		$c = new connect();
		$connection = $c->connection();

		$sql="SELECT id_category, name from categories";
		$result = mysqli_query($connection, $sql);
	?>
</head>
<body>
	<div class="container">
		<h1>Productos</h1>
		<div class="row">
			<div class="col-sm-4">
				<form id="productsForm" enctype="multipart/form-data">
					<label>Codigo de Barras</label>
					<input type="text" class="form-control input-sm" name="barcode" id="barcode">
					<label>Nombre</label>
					<input type="text" class="form-control input-sm" name="name" id="name">
					<label>Categoria</label>
					<select class="form-control input-sm" name="categorySelect" id="categorySelect">
						<option value="A">Selecciona Categoria</option>
						<?php while($view=mysqli_fetch_row($result)): ?>
						<option value="<?php echo $view[0] ?>"><?php echo $view[1]; ?></option>
						<?php endwhile; ?>
					</select>
					<label>Descripcion</label>
					<input type="text" class="form-control input-sm" name="description" id="description">
					<label>Cantidad</label>
					<input type="text" class="form-control input-sm" name="amount" id="amount">
					<label>Precio</label>
					<input type="text" class="form-control input-sm" name="price" id="price">
					<label>Imagen</label>
					<input type="file" name="image" id="image">
					<p></p>
					<span class="btn btn-primary" id="btnAddProduct">Agregar</span>
				</form>
			</div>
			<div class="col-sm-8">
				<div id="loadProductsTable"></div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="openModalUpdateProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Actualizar Datos del Producto</h4>
				</div>
				<div class="modal-body">
					<form id="uProductsForm" enctype="multipart/form-data">
						<input type="text" hidden="" name="productId" id="productId">
						<label>Codigo de Barras</label>
						<input type="text" class="form-control input-sm" name="uBarcode" id="uBarcode">
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" name="uName" id="uName">
						<label>Categoria</label>
						<select class="form-control input-sm" name="uCategorySelect" id="uCategorySelect">
							<option value="A">Selecciona Categoria</option>
							<?php 
								$sql="SELECT id_category, name from categories";
								$result = mysqli_query($connection, $sql);
							 ?>
							<?php while($view=mysqli_fetch_row($result)): ?>
							<option value="<?php echo $view[0] ?>"><?php echo $view[1]; ?></option>
							<?php endwhile; ?>
						</select>
						<label>Descripcion</label>
						<input type="text" class="form-control input-sm" name="uDescription" id="uDescription">
						<label>Cantidad</label>
						<input type="text" class="form-control input-sm" name="uAmount" id="uAmount">
						<label>Precio</label>
						<input type="text" class="form-control input-sm" name="uPrice" id="uPrice">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal" name="btnUpdateProduct" id="btnUpdateProduct">Actualizar</button>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	function addProductData(productid) {
		$.ajax({
			type:"POST",
			data:"prodid="+productid, 
			url:"../processes/products/getProductData.php",
			success:function(r) {
				data=jQuery.parseJSON(r);

				$('#productId').val(data['id_product']);
				$('#uBarcode').val(data['barcode']);
				$('#uName').val(data['name']);
				$('#uCategorySelect').val(data['id_category']);
				$('#uDescription').val(data['description']);
				$('#uAmount').val(data['amount']);
				$('#uPrice').val(data['price']);
			}
		});
	}

	function deleteProduct(productId) {
	alertify.confirm('Desea eliminar este producto?',
						function() {
							$.ajax({
								type:"POST",
								data:"productid=" + productId,
								url:"../processes/products/deleteProduct.php",
								success:function(r) {
									if (r == 1) {
										$('#loadProductsTable').load("products/productsTable.php");
										alertify.success("Eliminado con exito");
									} else {
										alertify.error("No se pudo eliminar");
									}
								}
							});
						},
						function() {
							alertify.error('Cancelado');
						});
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#btnUpdateProduct').click(function() {
			data=$('#uProductsForm').serialize();
			$.ajax({
				type:"POST",
				data:data, 
				url:"../processes/products/updateProducts.php",
				success:function(r) {
					if (r == 1) {
						$('#loadProductsTable').load("products/productsTable.php");
						alertify.success("Actualizado con exito!");
					} else {
						alertify.error("Error al actualizar");
					}
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#loadProductsTable').load("products/productsTable.php");

		$('#btnAddProduct').click(function() {

			empty = validateFormEmpty('productsForm');

			if (empty > 0) {
				alertify.alert("Se debe llenar todos los campos");
				return false;
			}

			var formData = new FormData(document.getElementById("productsForm"));

			$.ajax({
				url: "../processes/products/addProduct.php",
				type: "post",
				dataType: "html",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,

				success:function(r) {
					if (r == 1) {
						$('#productsForm')[0].reset();
						$('#loadProductsTable').load("products/productsTable.php");
						alertify.success("Agregado con exito!");
					} else {
						alertify.error("Fallo al subir el archivo");
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