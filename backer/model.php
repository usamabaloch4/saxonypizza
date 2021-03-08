<?php

/**
 * 
 */
class Model
{
	public $con;
	function __construct()
	{	
		$host = "localhost";
		$port = "5432"; // should be 5432
		$databaseName = "sindhipizza";
		$userName = "postgres";
		$password = "root";
		
		  $db_handle = new PDO("pgsql:" . "host=" . $host . ";port=" . $port . ";dbname=" . $databaseName, $userName, $password);

		$this->con = $db_handle;
	}

	public function getAllFrom($table, $condition = "")
	{
		$record = array();
		if($condition)
			$qry = $this->con->query("select * from $table where $condition order by id desc") or print_r($this->con->errorInfo());
		else
			$qry = $this->con->query("select * from $table order by id desc");

		return $qry->fetchAll();
	}

	public function getRowById($id, $table)
	{
		$qry = $this->con->query("select * from $table where id=". $id. ";") or print_r($this->con->errorInfo());
		return $qry->fetch();
	}

	/*

		Pizza Management area


	*/


	public function addPizza($data, $thumb)
	{
		$title = $data['ptitle'];
		$size = $data['psize'];
		$price = floatval($data['price']);
		$thumbnail = '';//$data[''];
		$qry = $this->con->query("call addpizza('$title', '$size', $price, '$thumbnail');");
		if($qry)
		{
			$id = $this->con->lastInsertId();
			$thumbnail = time().$thumb['name'];
			if(move_uploaded_file($thumb['tmp_name'], '../img/'.$thumbnail))
				$qry = $this->con->query("call updatepizza('$title', '$size', $price, '$thumbnail',$id);");
			else 
				die();
		}
		else
		{
			$error = $this->con->errorInfo();
			$error = $error[2];
			$error = explode('CONTEXT', $error);
			return $error[0];
		}

		return 'success';

	}


	public function updatePizza($id, $data)
	{
		$title = $data['ptitle'];
		$size = $data['psize'];
		$price = $data['price'];
		$thumbnail = $data['thumbnail'];
		$qry = $this->con->query("call updatepizza('$title', '$size', $price, '$thumbnail',$id);");
		if($qry)
			return 'success';
		else
		{
			$error = $this->con->errorInfo();
			$error = $error[2];
			$error = explode('CONTEXT', $error);
			return $error[0];
		}

	}

	public function getPizzaByid($id)
	{
		$qry = $this->con->query(" select * from basepizza where id='". $id. "';") or print_r($this->con->errorInfo());
		return $qry->fetch();
	}



	/*

		Ingredient Management Area


	*/

	public function addIngredient($title, $thumb)
	{
		if(empty($thumb['name']))
			return "You must choose a thumbnail for ingredient.";

		$thumbnail = time().$thumb['name'];

		if(move_uploaded_file($thumb['tmp_name'], '../img/'.$thumbnail))
			$qry = $this->con->query("call addingredient('$title', '$thumbnail', 0);");

		if($qry)
		{
			return 'success';			
		}
		else
		{
			$error = $this->con->errorInfo();
			$error = $error[2];
			$error = explode('CONTEXT', $error);
			return $error[0];
		}


	}

	public function updateIngredient($title, $status=0,  $id)
	{
		$qry = $this->con->query("call updateingredient('$title', $status, $id);");
		if($qry)
			return 'success';
		else
		{
			$error = $this->con->errorInfo();
			$error = $error[2];
			$error = explode('CONTEXT', $error);
			return $error[0];
		}

	}


	/*

		Supplier Management Area


	*/

	public function addSupplier($data)
	{
		$name = $data['sname'];
		$phone = intval($data['sphone']);
		$address = $data['saddress'];

		$qry = $this->con->query("call addsupplier('$name', '$address', $phone, 0);");
		if($qry)
		{
			return 'success';			
		}
		else
		{
			$error = $this->con->errorInfo();
			$error = $error[2];
			$error = explode('CONTEXT', $error);
			return $error[0];
		}

	}

	public function updateSupplier($id, $data)
	{
		$sname = $data['sname'];
		$sphone = $data['sphone'];
		$saddress = $data['saddress'];
		$qry = $this->con->query("call updatesupplier('$sname', '$saddress', $sphone,$id);");
		if($qry)
			return 'success';
		else
		{
			$error = $this->con->errorInfo();
			$error = $error[2];
			$error = explode('CONTEXT', $error);
			return $error[0];
		}

	}


	/*

		Stock Management

	*/

	public function addStock($data)
	{
		$supplier = $_POST['supplier'];
		$provenance = $_POST['provenance'];
		$ingredient = $_POST['ingredient'];
		$price = $_POST['price'];
		$stock = $_POST['stock'];


		$qry = $this->con->query("call addstock($ingredient, $supplier, $price, $stock, '$provenance');");
		if($qry)
			return 'success';
		else
		{
			$error = $this->con->errorInfo();
			$error = $error[2];
			$error = explode('CONTEXT', $error);
			return $error[0];
		}


	}

	public function getStockReportByIngredient($ingredient)
	{
		$qry =  $this->con->query("select * from getstockbyingredient($ingredient);") or print_r($this->con->errorInfo());
		return $qry->fetchAll();
	}


	public function reStock($stid, $qty)
	{
		$qry = $this->con->query("call restock($stid, $qty);");
		if($qry)
			return 'Stock Updated';
		else
		{
			$error = $this->con->errorInfo();
			$error = $error[2];
			$error = explode('CONTEXT', $error);
			return $error[0];
		}
	}






	public function deleteById($id, $table)
	{
		$qry = $this->con->query("call deleteitembyid($id, '$table');");
		return $qry;
	}
	public function changeStatus($status, $id, $table)
	{
		$qry = $this->con->query("call updatestatusbyid($status, $id, '$table');");
		return $qry;
	}


	public function addToCart($data)
	{
		$orderid = @$_SESSION['orderid'];
		$_SESSION['incorder'] = $data;
		if($orderid == "")
		{
			$qry = $this->con->query("select * from createorder('', 0, '', 0);");
			$oid = $qry->fetch();
			$orderid = $oid[0];


			$_SESSION['orderid'] = $orderid;
		}


		$bp = $this->con->query("select * from addorderitem($orderid, $data[basepizza], 1, NULL);") or print_r($this->con->errorInfo());
		$bp = $bp->fetch();
		$basepizza = $bp[0];

		$_SESSION['incorder']['bpid'] = $basepizza;

		$errors = array();

		foreach($data['ingredient'] as $ing)
		{
			$ingqry = $this->con->query("select * from addorderitem($orderid, $ing, 2, $basepizza);");
			if($ingqry)
			{
				$_SESSION['incorder']['added'][] = $ing;
			}
			else
			{
				$error = $this->con->errorInfo();
				$error = $error[2];
				$error = explode('CONTEXT', $error);
				$errors[]= $error[0];
			}
		}
		

		if(empty($errors))
		{
			$_SESSION['incorder'] = array();
			return "success";
		}
		else
		{
			return $errors;
		}
		
	}

	public function reOrder($data)
	{
		$incorder = $_SESSION['incorder'];
		$remaining = array_diff($data['ingredient'], $_SESSION['incorder']['added']);
		$basepizza = $_SESSION['incorder']['bpid'];
		$orderid = $_SESSION['orderid'];
		foreach($remaining as $ing)
		{
			$ing = $this->con->query("select * from addorderitem($orderid, $ing, 2, $basepizza);");
			if($ing)
			{
				$_SESSION['incorder']['added'][] = $ing;
			}
			else
			{
				$error = $this->con->errorInfo();
				$error = $error[2];
				$error = explode('CONTEXT', $error);
				$errors[]= $error[0];
			}
		}

		if(empty($errors))
		{
			$_SESSION['incorder'] = array();
			return "success";
		}
		else
		{
			return $errors;
		}
	}


	public function getCartItems($oid)
	{
		$qry = $this->con->query("select * from getorderitems($oid)") or print_r($this->con->errorInfo());

		$data = $qry->fetchAll(PDO::FETCH_ASSOC);

		$sorted = array();
		$i=0;
		foreach($data as $k)
		{
			if($k['dependson'] == "")
			{
				$sorted[$k['id']] = $k;
				$sorted[$k['id']]['ingredients']= array();
			}
			else
			{
				$sorted[$k['dependson']]["ingredients"][] = $k;
			}
			$i++;
		}
		return $sorted;
	}

	public function placeOrder($data)
	{
		$cphone = intval($data['cphone']);
		$qry = $this->con->query("call placeorder('$data[oid]', '$data[cname]', $cphone, '$data[caddress]');");
		if($qry)
			return 'success';
		else
		{
			$error = $this->con->errorInfo();
			$error = $error[2];
			$error = explode('CONTEXT', $error);
			return $error[0];
		}
	}

}

?>