<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 27, 2018
Manages products table.
-->
<?php
require_once('dbcon.php');
$dbObj = new DBManagement();
Class ProductManagement{

	function createProduct($name,$description,$stock,$price, $catalogID){
		$query = "INSERT INTO products(name, description, stock, price, fk_catalogID) values
              ('".$name."', '".$description."', '".$stock.", '".$price." , '".$catalogID." ')";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
		
	function getProducts(){
		$query = "Select * from products";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	
	function getProduct($productID){
		$query = "Select * from products where productID = " + $productID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	
	function deleteProduct($productID){
		$query = "DELETE FROM products WHERE productID = " + $productID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	
	function updateProduct($productID,$name,$description,$stock,$price, $catalogID){
		$query = "UPDATE products SET name='" + $name + "', " +
				 "description='" + $description + "', stock='" + $stock +
				 "', price='" +$price+ "', catalogID='" +$catalogID+ "' " +
				 "Where productID=" +$productID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	
}	
?>