<?php 
	session_start();
	if(isset($_SESSION['user'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ventas</title>
	<?php require_once "menu.php"; ?>
</head>
<body>
	<div class="container">
		<h1>Ventas</h1>
		<div class="row">
			<div class="col-sm-12">
				<div id="loadSalesTable"></div>
			</div>
		</div>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function() {
		$('#loadSalesTable').load("sales/salesTable.php");
	});
</script>

<?php 
	} else {
		header("location:../index.php");
	}
?>