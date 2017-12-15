<script type="text/javascript">

		$('#btnAddSale').click(function() {

			empty = validateFormEmpty('sellProductForm');

			if (empty > 0) {
				alertify.alert("Se debe llenar todos los campos");
				return false;
			}

			data=$('#sellProductForm').serialize();
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
</script>