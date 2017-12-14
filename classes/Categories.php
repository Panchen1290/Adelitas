<?php 
	class categories {
		public function addCategory($data) {
			$c = new connect();
			$connection = $c->connection();

			$sql="INSERT into categories (id_user,
										name,
										captureDate)
							values ('$data[0]',
									'$data[1]',
									'$data[2]')";

			return mysqli_query($connection, $sql);
		}

		public function updateCategory($data) {
			$c = new connect();
			$connection = $c->connection();

			$sql="UPDATE categories set name='$data[1]' where id_category='$data[0]'";

			echo mysqli_query($connection, $sql);
		}

		public function deleteCategory($categoryid) {
			$c = new connect();
			$connection = $c->connection();

			$sql="DELETE from categories where id_category='$categoryid'";

			return mysqli_query($connection, $sql);
		}
	}
 ?>