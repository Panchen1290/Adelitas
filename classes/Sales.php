<?php 
	class sales {
		public function getProductDataByName($productid) {
			$c=new connect();
			$connection=$c->connection();

			$sql="SELECT id_product, barcode, name, description, price from products where id_product='$productid'";

			$result = mysqli_query($connection, $sql);

			$view = mysqli_fetch_row($result);

			$data = array(
						'barcode' => $view[1],
						'name' => $view[2],
						'description' => $view[3],
						'price' => $view[4]
					);

			return $data;
		}

		public function getProductDataByBarcode($barcode) {
			$c=new connect();
			$connection=$c->connection();

			$sql="SELECT id_product, barcode, name, description, price from products where barcode='$barcode'";

			$result = mysqli_query($connection, $sql);

			$view = mysqli_fetch_row($result);

			$data = array(
						'barcode' => $view[1],
						'id_product' => $view[0],
						'description' => $view[3],
						'price' => $view[4]
					);

			return $data;
		}

		public function createSale() {
			$c=new connect();
			$connection=$c->connection();

			$date = date('Y-m-d');
			$saleid = self::createFile();
			$userid = $_SESSION['userid'];
			$data = $_SESSION['tempSellTable'];
			$r = 0;

			for ($i=0; $i < count($data); $i++) { 
				$d = explode("||", $data[$i]);

				$totalPrice = $d[3]*$d[4];

				$sql="INSERT into sales (id_sale,
										 id_client,
										 id_product,
										 id_user,
										 amount,
										 unitPrice,
										 totalPrice,
										 saleDate)
							values ('$saleid',
									'$d[6]',
									'$d[0]',
									'$userid',
									'$d[3]',
									'$d[4]',
									'$totalPrice',
									'$date')";

				$r = $r + $result = mysqli_query($connection, $sql);
			}

			return $r;
		}

		public function createFile() {
			$c=new connect();
			$connection=$c->connection();

			$sql="SELECT id_sale from sales group by id_sale desc";

			$result = mysqli_query($connection, $sql);
			$id = mysqli_fetch_row($result)[0];

			if ($id == "" or $id == null or $id == 0) {
				return 1;
			} else {
				return ($id + 1);
			}
		}

		public function clientName($clientId) {
			$c=new connect();
			$connection=$c->connection();

			$sql="SELECT lastname, name from clients
					where id_client='$clientId'";

			$result = mysqli_query($connection, $sql);

			$view = mysqli_fetch_row($result);

			return $view[0]." ".$view[1];
		}

		public function getTotal($saleid) {
			$c=new connect();
			$connection=$c->connection();

			$sql="SELECT totalPrice from sales
					where id_sale='$saleid'";

			$result = mysqli_query($connection, $sql);

			$total = 0;

			while($view=mysqli_fetch_row($result)) {
				$total = $total + $view[0];
			}

			return $total;
		}
	}
 ?>