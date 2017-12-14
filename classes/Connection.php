<?php 

	class connect {
		private $server="localhost";
		private $user="root";
		private $password="2312419013mysql";
		private $db="adelitas";

		public function connection() {
			$connection=mysqli_connect($this->server,
									  $this->user,
									  $this->password,
									  $this->db);

			return $connection;
		}
	}
 ?>