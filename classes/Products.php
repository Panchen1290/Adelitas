<?php 
	class products {
		public function addImage($data) {
			$c=new connect();
			$connection=$c->connection();

			$date=date('Y-m-d');

			$sql="INSERT into images (name,
									  filePath,
									  uploadDate)
						 values ('$data[0]','$data[1]','$date')";

			$result=mysqli_query($connection, $sql);

			return mysqli_insert_id($connection);
		}

		public function addProduct($data) {
			$c=new connect();
			$connection=$c->connection();

			$date=date('Y-m-d');
			
			$sql="INSERT into products (id_image,
										id_user,
										id_category,
										barcode,
										name,
										description,
										amount,
										price,
										captureDate)
							values ('$data[0]',
									'$data[1]',
									'$data[2]',
									'$data[3]',
									'$data[4]',
									'$data[5]',
									'$data[6]',
									'$data[7]',
									'$date')";

			return mysqli_query($connection, $sql);
		}

		public function getProductData($prodid) {
			$c=new connect();
			$connection=$c->connection();

			$sql="SELECT id_product,
						 barcode,
						 name,
						 id_category,
						 description,
						 amount,
						 price
						from products
						where id_product='$prodid'";

			$result = mysqli_query($connection, $sql);

			$view = mysqli_fetch_row($result);

			$data = array(
						"id_product" => $view[0],
						"barcode" => $view[1],
						"name" => $view[2],
						"id_category" => $view[3],
						"description" => $view[4],
						"amount" => $view[5],
						"price" => $view[6],
					);

			return $data;
		}

		public function updateProduct($data) {
			$c=new connect();
			$connection=$c->connection();

			$sql="UPDATE products set id_category='$data[1]',
									  barcode='$data[2]',
									  name='$data[3]',
									  description='$data[4]',
									  amount='$data[5]',
									  price='$data[6]'
								where id_product='$data[0]'";

			return mysqli_query($connection, $sql);
		}

		public function deleteProduct($productid) {
			$c=new connect();
			$connection=$c->connection();

			$imageid = self::getImgId($productid);

			$sql="DELETE from products where id_product='$productid'";

			$result = mysqli_query($connection, $sql);

			if ($result) {
				$path = self::getImgPath($imageid);

				$sql="DELETE from images where id_image='$imageid'";

				$result = mysqli_query($connection, $sql);

				if ($result) {
					if (unlink($path)) {
						return 1;
					}
				}
			}
		}

		public function getImgId($productId) {
			$c=new connect();
			$connection=$c->connection();

			$sql="SELECT id_image
					from products
					where id_product='$productId'";

			$result = mysqli_query($connection, $sql);

			return mysqli_fetch_row($result)[0];
		}

		public function getImgPath($imageId) {
			$c=new connect();
			$connection=$c->connection();

			$sql="SELECT filePath
					from images
					where id_image='$imageId'";

			$result = mysqli_query($connection, $sql);

			return mysqli_fetch_row($result)[0];
		}		
	}
 ?>