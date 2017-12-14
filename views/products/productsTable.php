<?php 
	require_once "../../classes/Connection.php";

	$c = new connect();
	$connection = $c->connection();

	$sql="SELECT prod.barcode,
				 prod.name,
				 prod.description,
				 prod.amount,
				 prod.price,
				 cat.name,
				 img.filePath,
				 prod.id_product
		  from products as prod
		  inner join categories as cat
		  on prod.id_category=cat.id_category
		  inner join images as img
		  on prod.id_image=img.id_image";

	$result = mysqli_query($connection, $sql);
 ?>

<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		<caption><label>Productos</label></caption>
		<tr>
			<td>Cod. de Barras</td>
			<td>Nombre</td>
			<td>Descripcion</td>
			<td>Cantidad</td>
			<td>Precio</td>
			<td>Categoria</td>
			<td>Imagen</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</tr>
		<?php 
			while($view = mysqli_fetch_row($result)):
		 ?>
		<tr>
			<td><?php echo $view[0]; ?></td>
			<td><?php echo $view[1]; ?></td>
			<td><?php echo $view[2]; ?></td>
			<td><?php echo $view[3]; ?></td>
			<td><?php echo $view[4]; ?></td>
			<td><?php echo $view[5]; ?></td>
			<td>
				<?php
					$imgView=explode("/", $view[6]);
					$imgPath=$imgView[1]."/".$imgView[2]."/".$imgView[3];
				?>
				<img src="<?php echo $imgPath ?>" width="80" height="50">
			</td>
			<td>
				<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#openModalUpdateProduct" onclick="addProductData('<?php echo $view[7]; ?>')">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>
			<td>
				<span class="btn btn-danger btn-xs" onclick="deleteProduct('<?php echo $view[7]; ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
		</tr>
		<?php 
			endwhile;
		 ?>
	</table>
</div>