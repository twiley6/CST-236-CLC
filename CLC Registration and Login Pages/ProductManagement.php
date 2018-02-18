<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 27, 2018
Manages products table.
-->
<?php
require_once 'dbcon.php';
$dbObj = new DBManagement();

//Product class
Class Product{
	private $prodID;
	private $name;
	private $stock;
	private $price;
	private $catalogID;
	
	//get & set functions
	public function setProdID($prodID){
		$this->prodID= $prodID;
	}
	
	public function getProdID(){
		return $this->prodID;
	}
	
	public function setName($name){
		$this->name = $name;
	}
	
	public function getName(){
		return $this->name;
	}
			
	public function setStock($stock){
		$this->stock = $stock;
	}
	
	public function getStock(){
		return $this->stock;
	}
	
	public function setPrice($price){
		$this->price= $price;
	}
	
	public function getPrice(){
		return $this->price;
	}
	
	public function setCatalogID($catalogID){
		$this->catalogID= $catalogID;
	}
	
	public function getCatalogID(){
		return $this->catalogID;
	}	
}

//Product methods
Class ProductManagement{
	
    //inserts a product
	public function createProduct(Product $nProd){
		$query = "INSERT INTO products(name, stock, price, fk_catalogID) values
              ('".$nProd->getName().
			   "', ".$nProd->getStock()." , ".$nProd->getPrice().
		       " , ".$nProd->getCatalogID().")";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	
	//returns list of products	
	public function getProducts(){
		$query = "Select * from products";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	
	//returns single product
	public function getProduct($productID){
		$query = "Select * from products where productID = " . $productID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	
	//delete products with catalogID
	public function deleteProductsWithCatalogID($catalogID){
		$query = "DELETE FROM products WHERE fk_catalogID = " . $catalogID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	
	//deletes a product
	public function deleteProduct($productID){
		$query = "DELETE FROM products WHERE productID = " . $productID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}

	//updates product not checking old data
	public function updateProductWithoutOldData(Product $nProd){
		$newQuery = "UPDATE products SET name='".$nProd->getName().
				"', stock=".$nProd->getStock().
				" , price=".$nProd->getPrice().
				" , fk_catalogID=".$nProd->getCatalogID().
				" Where productID=".$nProd->getProdID();
		
		return $GLOBALS['dbObj']->dbQuery($newQuery);
	}
	
	//TODO: updates a product checking old data
	public function updateProduct(Product $oProd,Product $nProd){
		
		$oldQuery = "SELECT * FROM products WHERE name='" . $$oProd->getName(). 
		"' AND stock=".$oProd->getStock().
		" AND price=".$oProd->getPrice().
		" AND fk_catalogID=".$oProd->getCatalogID(). 
		" AND productID=".$oProd->getProdID();
		
		$newQuery = "UPDATE products SET name='".$$nProd->getName()."', ". 
				 "', stock=".$nProd->getStock().
				 " , price=".$nProd->getPrice().
				 " , fk_catalogID=".$nProd->getCatalogID().
				 " Where productID=".$nProd->getProdID();
		
		return $GLOBALS['dbObj']->dbUpdate($oldQuery,$newQuery);
	}	
	
	//Gets products based on catalogID
	public function getProductsWithCatalogID($catalogID){
		$newQuery = "SELECT * products ".
		" WHERE fk_catalogID=".$catalogID;
		
		return $GLOBALS['dbObj']->dbQuery($newQuery);
	}
	
	//Gets products based on product name
	public function getProductsWithName($name){
		$newQuery = "SELECT * products ".
				" WHERE name LIKE %'".$name."%'";
		
		return $GLOBALS['dbObj']->dbQuery($newQuery);
	}
}	
?>