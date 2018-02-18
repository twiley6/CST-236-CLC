<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 27, 2018
Manages catalog table.
-->
<?php
require_once 'dbcon.php';

$dbObj = new DBManagement();

Class Catalog{
	
	private $catalogID;
	private $name;
	
	//get & set functions
	public function setCatalogID($catalogID){
		$this->catalogID = $catalogID;
	}
		
	public function getCatalogID(){
		return $this->catalogID;
	}
	
	public function setName($name){
		$this->name= $name;
	}
	
	public function getName(){
		return $this->name;
	}
	
}

Class catalogManagement{
	
    //inserts a catalog
	public function createCatalog($name){
		$query = "INSERT INTO catalog(name) values
              ('".$name."')";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	//gets all catalogs	
	public function getCatalogs(){
		$query = "Select * from catalog";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	//gets a single catalog
	public function getCatalog($catalogID){
		$query = "Select * from catalog where catalogID = " . $catalogID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	//deletes a catalog
	public function deleteCatalog($catalogID){;
		$query = "DELETE FROM catalog WHERE catalogID = " . $catalogID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	//updates a catalog
	public function updateCatalog(catalog $oCatalog, catalog $nCatalog){
		
		$oldQuery = "SELECT * FROM catalog WHERE name='".$oCatalog->getName().
		"' AND catalogID=".$oCatalog->getCatalogID();
		
		$newQuery = "UPDATE catalog SET name='".$nCatalog->getName(). 
		"' Where catalogID=".$nCatalog->getCatalogID();
		
		return $GLOBALS['dbObj']->dbUpdate($oldQuery,$newQuery);
	}
	
}	
?>