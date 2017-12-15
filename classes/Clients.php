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

		public function getClientData($clientid) {
			$c = new connect();
			$connection = $c->connection();

			$sql="SELECT id_client, name, lastname, code, tin from clients";

			$result = mysqli_query($connection, $sql);

			$view = mysqli_fetch_row($result);

			$data = array(
						'id_client' => $view[0],
						'name' => $view[1],
						'lastname' => $view[2],
						'code' => $view[3],
						'tin' => $view[4]
					);

			return $data;
		}

		public function updateClient($data) {
			$c = new connect();
			$connection = $c->connection();

			$sql="UPDATE clients set name='$data[1]',
									 lastname='$data[2]',
									 code='$data[3]',
									 tin='$data[4]'
							where id_client='$data[0]'";

			return mysqli_query($connection, $sql);
		}

		public function deleteClient($clientid) {
			$c = new connect();
			$connection = $c->connection();

			$sql="DELETE from clients where id_client='$clientid'";

			return mysqli_query($connection, $sql);
		}
	}
 ?>