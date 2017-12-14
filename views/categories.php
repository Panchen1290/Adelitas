<?php 
	session_start();
	if(isset($_SESSION['user'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Categorias</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
	<div class="container">
		<h1>Categorias</h1>
		<div class="row">
			<div class="col-sm-4">
				<form id="categoriesForm">
					<label>Categoria</label>
					<input type="text" class="form-control input-sm" name="category" id="category">
					<p></p>
					<span class="btn btn-primary" id="btnAddCategory">Agregar</span>
				</form>
			</div>
			<div class="col-sm-8">
				<div id="loadCategoriesTable"></div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="updateCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Actualiza Categoria</h4>
				</div>
				<div class="modal-body">
					<form id="uCategoryForm">
						<input type="text" hidden="" name="categoryid" id="categoryid">
						<label>Categoria</label>
						<input type="text" class="form-control input-sm" name="uCategory" id="uCategory">
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-warning" data-dismiss="modal" id="btnUpdateCategory">Guardar</button>
				</div>
			</div>
		</div>
	</div>

</body>
</html>

<script type="text/javascript" >
	$(document).ready(function() {

		$('#loadCategoriesTable').load("categories/categoriesTable.php");

		$('#btnAddCategory').click(function() {

			empty = validateFormEmpty('categoriesForm');

			if (empty > 0) {
				alertify.alert("Se debe llenar todos los campos");
				return false;
			}

			data=$('#categoriesForm').serialize();
			$.ajax({
				type:"POST",
				data:data, 
				url:"../processes/categories/addCategory.php",
				success:function(r) {
					if (r == 1) {
						$('#categoriesForm')[0].reset();
						$('#loadCategoriesTable').load("categories/categoriesTable.php");
						alertify.success("Categoria agregada con exito");
					} else {
						alertify.error("No se pudo agregar la cagetoria");
					}
				}
			});
		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#btnUpdateCategory').click(function() {
			data=$('#uCategoryForm').serialize();
			$.ajax({
				type:"POST",
				data:data, 
				url:"../processes/categories/updateCategory.php",
				success:function(r) {
					if (r == 1) {
						$('#loadCategoriesTable').load("categories/categoriesTable.php");
						alertify.success("Actualizado con exito!");
					} else {
						alertify.error("No se pudo actualizar");
					}
				}
			});
		});
	});
</script>

<script type="text/javascript">
	function addCategory(categoryId, category) {
		$('#categoryid').val(categoryId);
		$('#uCategory').val(category);
	}

	function deleteCategory(categoryId) {
		alertify.confirm('Desea eliminar esta categoria?',
							function() {
								$.ajax({
									type:"POST",
									data:"categoryid=" + categoryId,
									url:"../processes/categories/deleteCategory.php",
									success:function(r) {
										if (r == 1) {
											$('#loadCategoriesTable').load("categories/categoriesTable.php");
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

<?php 
	} else {
		header("location:../index.php");
	}
?>