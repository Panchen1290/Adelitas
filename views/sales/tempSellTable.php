<?php 
	session_start();
 ?>

<h2><strong><div id="saleClientName"></div></strong></h2>
<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered" style="text-align: center;">
		<caption>
			<span class="btn btn-success" onclick="createSale()">Registrar Venta
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
				$i=0;
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
			<td><?php echo $d[3]*$d[4]." Bs." ?></td>
 			<td>
				<span class="btn btn-danger btn-xs" onclick="removeProduct('<?php echo $i; ?>')">
					<span class="glyphicon glyphicon-remove"></span>
				</span>
			</td>
		</tr>
		<?php
					$total = $total + ($d[3]*$d[4]);
					$i++;
					$client=$d[5];
				endforeach; 
			endif;
		 ?>
		 <tr>
		 	<td>Total de venta: <?php echo $total." Bs."; ?></td>
		 </tr>
	</table>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		name="<?php echo @$client ?>";
		$('#saleClientName').text("Cliente: "+name);
	});
</script>