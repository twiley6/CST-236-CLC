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

Class catalog{
	
	private $catalogID;
	private $name;
	
	//get & set functions
	public function setCatalogID($catalogID){
		this.$catalogID = $catalogID;
	}
		
	public function getCatalogID(){
		return this.$catalogID;
	}
	
	public function setName($name){
		this.$name= $name;
	}
	
	public function getName(){
		return this.$name;
	}
	
}

Class catalogManagement{
	
	private $dbObj = new DBManagement();
    //inserts a catalog
	public function createCatalog($name){
		$query = "INSERT INTO catalog(name) values
              ('"+$name+"')";
		return $dbObj->dbInsert($query);
	}
	//gets all catalogs	
	public function getCatalogs(){
		$query = "Select * from catalog";
		return $dbObj->dbArrayResult($query);
	}
	//gets a single catalog
	public function getCatalog($catalogID){
		$query = "Select * from catalog where productID = " + $catalogID;
		return $dbObj->dbSingleResult($query);
	}
	//deletes a catalog
	public function deleteCatalog($catalogID){;
		$query = "DELETE FROM catalog WHERE productID = " + $catalogID;
		return $dbObj->dbDelete($query);
	}
	//updates a catalog
	public function updateCatalog(catalog $oCatalog, catalog $nCatalog){
		
		$oldQuery = "SELECT * FROM catalog WHERE name='" + $oCatalog->getName() +
		"' AND catalogID=" +$oCatalog->getCatalogID();
		
		$newQuery = "UPDATE catalog SET name='" + $nCatalog->getName() + 
		"' Where catalogID=" +$nCatalog->getCatalogID();
		
		return $dbObj->dbUpdate($oldQuery,$newQuery);
	}
	
}	
?>