<!DOCTYPE html>
<html lang="en">
<head>
	<title>Menu</title>
	<?php require_once "dependencies.php"; ?>
</head>
<body>
	
	<!-- Begin Navbar -->
	<div id="nav">
		<div class="navbar navbar-inverse navbar-fixed-top" data-spy="affix" data-offset-top="100">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="init.php"><img class="img-responsive logo img-thumbnail" src="../img/menu_logo.jpg" alt="" width="80px" height="40px"></a>
				</div>
				<div id="navbar" class="collapse navbar-collapse">

					<ul class="nav navbar-nav navbar-right">
						<li><a href="init.php"><span class="glyphicon glyphicon-home"></span>Inicio</a></li>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-glass"></span>Administrar Inventario<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="categories.php">Categorias</a></li>
							<li><a href="products.php">Productos</a></li>
						</ul>
					</li>

					<?php 
						if ($_SESSION['user'] == "admin") :

					 ?>
					<li><a href="users.php"><span class="glyphicon glyphicon-user"></span>Administrar usuarios</a>
					</li>
					 <?php 
					 	endif;
					  ?>

					<li><a href="clients.php"><span class="glyphicon glyphicon-user"></span>Clientes</a>
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-usd"></span>Ventas<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="sell.php">Vender</a></li>
							<li><a href="sales.php">Ventas</a></li>
						</ul>
					</li>

					<li class="dropdown" >
						<a href="#" style="color: red"  class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Usuario: <?php echo $_SESSION['user']; ?>  <span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li> <a style="color: red" href="../processes/logout.php"><span class="glyphicon glyphicon-off"></span>Salir</a></li>

						</ul>
					</li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
		<!--/.contatiner -->
	</div>
</div>


</body>
</html>

<script type="text/javascript">
	$(window).scroll(function() {
		if ($(document).scrollTop() > 50000) {
			$('.logo').height(25);
			$('.logo').width(50);
		}
		else {
			$('.logo').height(25);
			$('.logo').width(50);

		}
	});
</script>