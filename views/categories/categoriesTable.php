<?php 
	require_once "../../classes/Connection.php";

	$c = new connect();
	$connection = $c->connection();

	$sql = "SELECT id_category, name FROM categories";

	$result = mysqli_query($connection, $sql);
 ?>

<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		<caption><label>Categorias</label></caption>
		<tr>
			<td>Categoria</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</tr>
		<?php 
			while ($view = mysqli_fetch_row($result)) :
		 ?>
		<tr>
			<td><?php echo $view[1] ?></td>
			<td>
				<span class="btn btn-warning btn-xs" data-toggle="modal" data-target="#updateCategory" onclick="addCategory('<?php echo $view[0] ?>', '<?php echo $view[1] ?>')">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>
			<td>
				<span class="btn btn-danger btn-xs" onclick="deleteCategory('<?php echo $view[0] ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
		</tr>
		<?php 
			endwhile;
		 ?>
	</table>
</div>