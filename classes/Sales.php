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
	}
 ?>