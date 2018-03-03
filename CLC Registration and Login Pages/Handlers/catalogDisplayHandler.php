<?php
include($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/ProductManagement.php');
header('Content-Type: application/json');
//Checks if we are receiving a post
if(isset($_POST)){

    //Pulls products based on their catalogID
    if (isset($_POST['catalogSearch'])){
        $pManagement = new ProductManagement();
        $i = 0;
        $qResult = $pManagement->getProductsWithCatalogID($_POST['catalogSearch']);
        while ($row = mysqli_fetch_array ($qResult)){
            $product[] = new Product();
            $product[$i]->setName($row["name"]);
            $product[$i]->setProdID($row["productID"]);
            $product[$i]->setPrice($row["price"]);
            $product[$i]->setStock($row["stock"]);
            $product[$i]->setCatalogID($row["fk_catalogID"]);        
            $i++;
        }
        echo json_encode($product);
    }

    //Pulls products based on their name
    if (isset($_POST['ProdSearchName'])){
        $pManagement = new ProductManagement();
        $i = 0;
        $qResult = $pManagement->getProductsWithName($_POST['ProdSearchName']);
        while ($row = mysqli_fetch_array ($qResult)){
            $product[] = new Product();
            $product[$i]->setName($row["name"]);
            $product[$i]->setProdID($row["productID"]);
            $product[$i]->setPrice($row["price"]);
            $product[$i]->setStock($row["stock"]);
            $product[$i]->setCatalogID($row["fk_catalogID"]);
            $i++;
        }
        echo json_encode($product);
    }


}
?>