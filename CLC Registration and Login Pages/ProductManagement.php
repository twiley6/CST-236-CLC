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

//Product class
Class Product{
	private $prodID;
	private $name;
	private $description;
	private $stock;
	private $price;
	private $catalogID;
	
	//get & set functions
	public function setProdID($prodID){
		this.$prodID= $prodID;
	}
	
	public function getProdID(){
		return this.$prodID;
	}
	
	public function setName($name){
		this.$name = $name;
	}
	
	public function getName(){
		return this.$name;
	}
	
	public function setDescription($description){
		this.$description= $description;
	}
	
	public function getDescription(){
		return this.$description;
	}
	
	public function setStock($stock){
		this.$stock = $stock;
	}
	
	public function getStock(){
		return this.$stock;
	}
	
	public function setPrice($price){
		this.$price= $price;
	}
	
	public function getPrice(){
		return this.$price;
	}
	
	public function setCatalogID($catalogID){
		this.$catalogID= $catalogID;
	}
	
	public function getCatalogID(){
		return this.$catalogID;
	}	
}

//Product CRUD methods
Class ProductManagement{
	
	private $dbObj = new DBManagement();
	
    //inserts a product
	public function createProduct(Product $nProd){
		$query = "INSERT INTO products(name, description, stock, price, fk_catalogID) values
              ('"+$nProd->getName()+"', '"+$nProd->getDescription()+
			   "', '"+$nProd->getStock()+", '"+$nProd->getPrice()+
		       " , '"+$nProd->getCatalogID()+" ')";
		return $dbObj->dbInsert($query);
	}
	
	//returns list of products	
	public function getProducts(){
		$query = "Select * from products";
		return $dbObj->dbArrayResult($query);
	}
	
	//returns single product
	public function getProduct($productID){
		$query = "Select * from products where productID = " + $productID;
		return $dbObj->dbSingleResult($query);
	}
	
	//delete products with catalogID
	public function deleteProductsWithCatalogID($catalogID){
		$query = "DELETE FROM products WHERE fk_catalogID = " + $catalogID;
		return $dbObj->dbDelete($query);
	}
	
	//deletes a product
	public function deleteProduct($productID){
		$query = "DELETE FROM products WHERE productID = " + $productID;
		return $dbObj->dbDelete($query);
	}

	//updates a product
	public function updateProduct(Product $oProd,Product $nProd){
		
		$oldQuery = "SELECT * FROM products WHERE name='" + $$oProd->getName()+ 
		"' AND description='" + $oProd->getDescription() +
		"' AND stock='" + $oProd->getStock() +
		"' AND price='" +$oProd->getPrice()+
		"' AND catalogID='" +$oProd->getCatalogID()+ 
		"' AND productID=" +$oProd->getProdID();
		
		$newQuery = "UPDATE products SET name='" + $$nProd->getName()+ "', " +
				 "description='" + $nProd->getDescription() + 
				 "', stock='" + $nProd->getStock() +
				 "', price='" +$nProd->getPrice()+ 
				 "', catalogID='" +$nProd->getCatalogID()+ "' " +
				 "Where productID=" +$nProd->getProdID();
		
		return $dbObj->dbUpdate($oldQuery,$newQuery);
	}	
}	
?>