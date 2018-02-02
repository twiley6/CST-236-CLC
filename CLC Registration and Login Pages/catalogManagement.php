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
Class catalogManagement{

	function createCatalog($name){
		$query = "INSERT INTO catalog(name) values
              ('".$name."')";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
		
	function getCatalogs(){
		$query = "Select * from catalog";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	
	function getCatalog($catalogID){
		$query = "Select * from catalog where productID = " + $catalogID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	
	function deleteCatalog($catalogID){
		$query = "DELETE FROM catalog WHERE productID = " + $catalogID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	
	function updateCatalog($name){
		$query = "UPDATE catalog SET name='" + $name + 
				 "' Where catalogID=" +$catalogID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	
}	
?>