<?php 
	class users {
		public function registerUser($data) {
			$c=new connect();
			$connection=$c->connection();

			$date = date('Y-m-d');

			$sql="INSERT into users(name,
								lastname,
								user,
								password,
								captureDate)
							values ('$data[0]',
									'$data[1]',
									'$data[2]',
									'$data[3]',
									'$date')";

			return mysqli_query($connection,$sql);
		}

		public function loginUser($data) {
			$c=new connect();
			$connection=$c->connection();			

			$password=sha1($data[1]);

			$_SESSION['user']=$data[0];
			$_SESSION['userid']=self::getID($data);

			$sql="SELECT * from users where user='$data[0]' and password='$password'";

			$result = mysqli_query($connection, $sql);

			if(mysqli_num_rows($result) > 0) {
				return 1;
			} else {
				return 0;
			}
		}

		public function getID($data) {
			$c=new connect();
			$connection=$c->connection();

			$password=sha1($data[1]);

			$sql="SELECT id_user from users where user='$data[0]' and password='$password'";

			$result = mysqli_query($connection, $sql);

			return mysqli_fetch_row($result)[0];
		}

		public function getUserData($userid) {
			$c=new connect();
			$connection=$c->connection();

			$sql="SELECT id_user,
						 name,
						 lastname,
						 user
					from users
					where id_user='$userid'";

			$result = mysqli_query($connection, $sql);

			$view = mysqli_fetch_row($result);

			$data = array(
						'id_user' => $view[0],
						'name' => $view[1],
						'lastname' => $view[2],
						'user' => $view[3]
					);

			return $data;
		}

		public function updateUser($data) {
			$c=new connect();
			$connection=$c->connection();

			$sql="UPDATE users set name='$data[1]',
						 		   lastname='$data[2]',
						 		   user='$data[3]'
							where id_user='$data[0]'";

			return mysqli_query($connection, $sql);
		}
	}
 ?>