<?php
/*CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Robert Nichols
Jan. 27, 2018
Manages products table.
*/
require_once ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/dbcon.php');
$dbObj = new DBManagement();
//Product class
Class Product{
    public $prodID;
    public $name;
    public $stock;
    public $price;
    public $catalogID;
    public $commID;
    public $rating;
    public $comment;

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

    public function setCommID($commID){
        $this->commID= $commID;
    }

    public function getCommID(){
        return $this->commID;
    }

    public function setRate($rating){
        $this->rating= $rating;
    }

    public function getRate(){
        return $this->rating;
    }

    public function setComment($comment){
        $this->comment= $comment;
    }

    public function getComment(){
        return $this->comment;
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
        $query = "Select p.*, c.* FROM products p JOIN comments c".
            " ON p.productID=c.fk_productID";
        return $GLOBALS['dbObj']->dbQuery($query);
    }

    //returns single product
    public function getProduct($productID){
        $query = "Select p.*, c.* FROM products p JOIN comments c".
            " ON p.productID=c.fk_productID WHERE p.productID = " . $productID;
        return $GLOBALS['dbObj']->dbQuery($query);
    }

    //delete products with catalogID
    public function deleteProductsWithCatalogID($catalogID){
        $query = "DELETE p.*, c.* FROM products p JOIN comments c".
            " ON p.productID=c.fk_productID WHERE p.fk_catalogID = " . $catalogID;
        return $GLOBALS['dbObj']->dbQuery($query);
    }

    //deletes a product
    public function deleteProduct($productID){
        $query = "DELETE p.*, c.* FROM products p JOIN comments c".
            " ON p.productID=c.fk_productID WHERE p.productID = " . $productID;
        return $GLOBALS['dbObj']->dbQuery($query);
    }
    //updates product not checking old data
    public function updateProductWithoutOldData(Product $nProd){
        $newQuery = "UPDATE products p, comments c SET p.name='".$$nProd->getName()."', ".
            " , p.stock=".$nProd->getStock().
            " , p.price=".$nProd->getPrice().
            " , p.fk_catalogID=".$nProd->getCatalogID().
            " , c.comment_id=".$nProd->getCommID().
            " , c.rating=".$nProd->getRate().
            " , c.comment=".$nProd->getComment().
            " Where p.productID=".$nProd->getProdID();

        return $GLOBALS['dbObj']->dbQuery($newQuery);
    }

    //TODO: updates a product checking old data
    public function updateProduct(Product $oProd,Product $nProd){

        $oldQuery = "SELECT p.*, c.* FROM products p JOIN comments c".
            " ON p.productID = c.fk_productID".
            " WHERE p.name='" . $$oProd->getName().
            " AND p.stock=".$oProd->getStock().
            " AND p.price=".$oProd->getPrice().
            " AND p.fk_catalogID=".$oProd->getCatalogID().
            " AND p.productID=".$oProd->getProdID().
            " AND c.comment_id=".$oProd->getCommID().
            " AND c.rating=".$oProd->getRate().
            " AND c.comment=".$oProd->getComment();

        $newQuery = "UPDATE products p, comments c SET p.name='".$$nProd->getName()."', ".
            " , p.stock=".$nProd->getStock().
            " , p.price=".$nProd->getPrice().
            " , p.fk_catalogID=".$nProd->getCatalogID().
            " , c.comment_id=".$nProd->getCommID().
            " , c.rating=".$nProd->getRate().
            " , c.comment=".$nProd->getComment().
            " Where p.productID=".$nProd->getProdID();

        return $GLOBALS['dbObj']->dbUpdate($oldQuery,$newQuery);
    }

    //Gets products based on catalogID
    public function getProductsWithCatalogID($catalogID){
        $newQuery = "SELECT p.*, c.* FROM products p JOIN comments c".
            " ON p.productID = c.fk_productID".
            " WHERE p.fk_catalog =".$catalogID;
//        $newQuery = "SELECT * from products".
//            " WHERE fk_catalogID=".$catalogID;

        return $GLOBALS['dbObj']->dbQuery($newQuery);
    }

    //Gets products based on product name
    public function getProductsWithName($name){
        $newQuery = "SELECT p.*, c.* from products p JOIN comments c".
            " ON p.productID = c.fk_productID".
            " WHERE p.name LIKE '%".$name."%'";

        return $GLOBALS['dbObj']->dbQuery($newQuery);
    }
}
?>