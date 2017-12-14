<?php 
	class clients {
		public function addClient($data) {
			$c = new connect();
			$connection = $c->connection();

			$userid=$_SESSION['userid'];

			$sql="INSERT into clients (id_user,
									  name,
									  lastname,
									  code,
									  tin)
							values ('$userid',
									'$data[0]',
									'$data[1]',
									'$data[2]',
									'$data[3]')";

			return mysqli_query($connection, $sql);
		}
	}
 ?>