<?php 
	session_start();
	if(isset($_SESSION['user'])) {

	require_once "../classes/Connection.php";
	$c = new connect();
	$connection = $c->connection();
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
					<form id="sellProductForm">
						<label>Selecciona Cliente</label>
						<select class="form-control input-sm" name="clientSelect" id="clientSelect">
							<option value="0" selected="selected">Sin cliente</option>
							<?php 
								$sql="SELECT id_client, name, lastname from clients";
								$result = mysqli_query($connection, $sql);

								while ($client = mysqli_fetch_row($result)) :
							?>
							<option value="<?php echo $client[0] ?>"><?php echo $client[2]." ".$client[1] ?></option>
							<?php 
							 	endwhile;
							?>
						</select>
						<label>Codigo de Producto</label>
						<input class="form-control input-sm" name="barcode" id="barcode"></input>
						<label>Selecciona Producto</label>
						<select class="form-control input-sm" name="productSelect" id="productSelect">
							<option value="A">Seleccionar</option>
							<?php 
								$sql="SELECT id_product, name from products";
								$result = mysqli_query($connection, $sql);
								while ($product = mysqli_fetch_row($result)) :
							?>
							<option value="<?php echo $product[0] ?>"><?php echo $product[1] ?></option>
							<?php 
								endwhile;
							 ?>
						</select> 
						<label>Cantidad</label>
						<input type="text" class="form-control input-sm" name="amount" id="amount">
						<label>Descripcion</label>
						<input type="text" readonly="" class="form-control input-sm" name="description" id="description">
						<label>Precio</label>
						<input type="text" readonly="" class="form-control input-sm" name="price" id="price">
						<p></p>
						<span class="btn btn-primary" id="btnAddToSale">Agregar</span>
						<span class="btn btn-danger" id="btnEmptySale">Vaciar Productos</span>
					</form>
				</div>
				<div class="col-sm-8">
 					<div id="loadTempSellTable"></div>
				</div>
			</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#loadTempSellTable').load("sales/tempSellTable.php");

		$('#btnAddToSale').click(function() {
			empty = validateFormEmpty('sellProductForm');

			if (empty > 0) {
				alertify.alert("Se debe llenar todos los campos");
				return false;
			}

			data=$('#sellProductForm').serialize();
			$.ajax({
				type:"POST",
				data:data, 
				url:"../processes/sales/addProductTemp.php",
				success:function(r) {
					$('#loadTempSellTable').load("sales/tempSellTable.php");
				}
			});
		});

		$('#btnEmptySale').click(function() {
			$.ajax({
				url:"../processes/sales/emptyTemp.php",
				success:function(r) {
					$('#loadTempSellTable').load("sales/tempSellTable.php");
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#productSelect').change(function() {
			$.ajax({
				type:"POST",
				data:"productid="+$('#productSelect').val(), 
				url:"../processes/sales/fillProductFormByName.php",
				success:function(r) {
					data = jQuery.parseJSON(r);
					$('#barcode').val(data['barcode']);
					$('#amount').val(1);
					$('#description').val(data['description']);
					$('#price').val(data['price']);
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#barcode').change(function() {
			$.ajax({
				type:"POST",
				data:"productbarcode="+$('#barcode').val(), 
				url:"../processes/sales/fillProductFormByBarcode.php",
				success:function(r) {
					data = jQuery.parseJSON(r);
					$('#productSelect').val(data['id_product']);
					$('#productSelect').change();
					$('#amount').val(1);
					$('#description').val(data['description']);
					$('#price').val(data['price']);
				}
			});
		});
	});
</script>

<script type="text/javascript">
	function removeProduct(index) {
		$.ajax({
			type:"POST",
			data:"ind="+index, 
			url:"../processes/sales/removeProduct.php",
			success:function(r) {
				$('#loadTempSellTable').load("sales/tempSellTable.php");
				alertify.success("Se removio el producto");
			}
		});
	}

	function createSale() {
		$.ajax({
			url:"../processes/sales/createSale.php",
			success:function(r) {
				$('#loadTempSellTable').load("sales/tempSellTable.php");
				$('#sellProductForm')[0].reset();
				if (r > 0) {
					alertify.alert("Venta hecha con exito, consulte la informacion en Ventas");
				} else if (r == 0) {
					alertify.alert("No hay lista de venta");
				} else {
					alertify.error("No se pudo crear la venta");
				}
			}
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#clientSelect').select2();
		$('#productSelect').select2();
	});
</script>

<?php 
	} else {
		header("location:../index.php");
	}
?>