<?php 
	require_once "../../classes/Connection.php";
	require_once "../../classes/Sales.php";

	$c=new connect();
	$connection=$c->connection();


	$obj = new sales();

	$sql="SELECT id_sale, saleDate, id_client from sales
			group by id_sale";

	$result = mysqli_query($connection, $sql);
 ?>
<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		<caption><label>Ventas</label></caption>
		<tr>
			<td>Folio</td>
			<td>Fecha</td>
			<td>Cliente</td>
			<td>Total de Compra</td>
			<td>Ticket</td>
			<td>Reporte</td>
		</tr>
		<?php 
			while ($view = mysqli_fetch_row($result)) :
		 ?>
		<tr>
			<td><?php echo $view[0] ?></td>
			<td><?php echo $view[1] ?></td>
			<td>
				<?php 
					if ($obj->clientName($view[2]) == " ") {
						echo "S/C";
					} else {
						echo $obj->clientName($view[2]);
					}
				 ?>
			</td>
			<td>
				<?php 
					echo $obj->getTotal($view[0]);
				 ?>
			</td>
			<td>
				<a href="#"	class="btn btn-danger btn-sm">
					Ticket <span class="glyphicon glyphicon-list-alt"></span>
				</a>
			</td>
			<td>
				<a href="../processes/sales/createPdfReport.php?saleid=<?php echo $view[0] ?>" class="btn btn-danger btn-sm">
					Reporte <span class="glyphicon glyphicon-file"></span>
				</a>
			</td>
		</tr>
		<?php 
			endwhile;
		 ?>
	</table>
</div>