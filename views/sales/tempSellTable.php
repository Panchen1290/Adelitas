<?php 
	session_start();
 ?>

<h2><div id="saleClientName"></div></h2>
<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		<caption>
			<span class="btn btn-success">Registrar Venta
				<span class="glyphicon glyphicon-usd"></span>
			</span>
		</caption>
		<caption><label>Venta</label></caption>
		<tr>
			<td>Imagen</td>
			<td>Producto</td>
			<td>Cantidad</td>
			<td>Precio</td>
			<td>Eliminar</td>
		</tr>
		<?php 
			$total=0;
			$client="";
			if (isset($_SESSION['tempSellTable'])) :
				foreach (@$_SESSION['tempSellTable'] as $key) :
					$d = explode("||", @$key);
		 ?>
		<tr>
			<td>
				<?php
					$imgView=explode("/", $d[1]);
					$imgPath=$imgView[1]."/".$imgView[2]."/".$imgView[3];
				?>
				<img class="img-thumbnail" src="<?php echo $imgPath ?>" width="80" height="50">
			</td>
			<td><?php echo $d[2] ?></td>
			<td><?php echo $d[3] ?></td>
			<td><?php echo $total ?></td>
 			<td>
				<span class="btn btn-danger btn-xs">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
		</tr>
		<?php
				endforeach; 
			endif;
		 ?>
	</table>
</div>