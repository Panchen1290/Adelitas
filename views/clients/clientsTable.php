<?php 
	require_once "../../classes/Connection.php";

	$c = new connect();
	$connection = $c->connection();

	$sql="SELECT id_client, name, lastname, code, tin from clients";

	$result = mysqli_query($connection, $sql);
 ?>

<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		<caption><label>Clientes</label></caption>
		<tr>
			<td>Nombre</td>
			<td>Apellido</td>
			<td>Codigo</td>
			<td>NIT</td>
			<td>Editar</td>
			<td>Eliminar</td>
		</tr>
		<?php while ($view = mysqli_fetch_row($result)) : ?>
		<tr>
			<td><?php echo $view[1]; ?></td>
			<td><?php echo $view[2]; ?></td>
			<td><?php echo $view[3]; ?></td>
			<td><?php echo $view[4]; ?></td>
			<td>
				<span class="btn btn-warning btn-xs">
					<span class="glyphicon glyphicon-pencil"></span>
				</span>
			</td>
			<td>
				<span class="btn btn-danger btn-xs">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
		</tr>
		<?php endwhile; ?>
	</table>
</div>