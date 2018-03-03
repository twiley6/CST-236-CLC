<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Robert Nichols
Feb. 2, 2018
Handles catalog creation -->
<?php
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/catalogManagement.php');
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/ProductManagement.php');
//Checks if we are receiving a post
if(isset($_POST)){
//Catalog create handler
if (isset($_POST['catalogNameCeate'])){
$name = $_POST['catalogNameCeate'];
$cManagement = new catalogManagement();
$cManagement->createCatalog($name);
exit();
}

//Catalog update handler
if(isset($_POST['catalogNameUpdate']) && isset($_POST['catalogIDUpdate']) && isset($_POST['oldCatalogName']))
{
$cManagement = new catalogManagement();
$uCatalog = new Catalog();
$oCatalog = new Catalog();
$oCatalog->setCatalogID($_POST['catalogIDUpdate']);
$oCatalog->setName($_POST['oldCatalogName']);
$uCatalog->setName($_POST['catalogNameUpdate']);
$uCatalog->setCatalogID($_POST['catalogIDUpdate']);
$cManagement->updateCatalog($oCatalog,$uCatalog);
exit();
}
//Deletes all products with catalogID and then deletes catalog
if(isset($_POST['catalogDeleteID']))
{
$pManagement = new productManagement();
$id = $_POST['catalogDeleteID'];
$cManagement = new catalogManagement();
$pManagement->deleteProductsWithCatalogID($id);
$cManagement->deleteCatalog($id);
exit();
}

}
?>