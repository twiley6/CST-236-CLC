<?php
include('ProductManagement.php');
//Checks if we are receiving a post
if(isset($_POST)){

    //Product create handler
    if (isset($_POST['ProdNameCeate']) && isset($_POST['ProdDescripCreate']) &&
        isset($_POST['ProdQOHCreate']) && isset($_POST['PRODPriceCreate']) &&
        isset($_POST['CatalogfkCreate'])){

        $nProduct = new Product();
        $pManagement = new ProductManagement();
        $nProduct->setName($_POST['ProdNameCeate']);
        $nProduct->setDescription($_POST['ProdDescripCreate']);
        $nProduct->setStock($_POST['ProdQOHCreate']);
        $nProduct->setPrice($_POST['PRODPriceCreate']);
        $nProduct->setCatalogID($_POST['CatalogfkCreate']);
        $pManagement->createProduct($nProduct);
        echo $nProduct->getName().' '.$nProduct->getDescription().' '.
            $nProduct->getStock().' '.$nProduct->getPrice().' '.
            $nProduct->getCatalogID();
        exit();
    }


    //Product update with just new data
    if(isset($_POST['ProdNameUpdate']) && isset($_POST['ProdDescripUpdate']) &&
        isset($_POST['ProdQOHUpdate']) && isset($_POST['ProdPriceUpdate']) &&
        isset($_POST['CatalogfkUpdate']) && isset($_POST['ProdID']))
    {

        $pManagement = new ProductManagement();
        $uProduct = new Product();
        $uProduct->setName($_POST['ProdNameUpdate']);
        $uProduct->setDescription($_POST['ProdDescripUpdate']);
        $uProduct->setStock($_POST['ProdQOHUpdate']);
        $uProduct->setPrice($_POST['ProdPriceUpdate']);
        $uProduct->setCatalogID($_POST['CatalogfkUpdate']);
        $uProduct->setProdID($_POST['ProdID']);
        $pManagement->updateProductWithoutOldData($uProduct);
        echo $uProduct->getName().' '.$uProduct->getDescription().' '.
            $uProduct->getStock().' '.$uProduct->getPrice().' '.
            $uProduct->getCatalogID().' '.$uProduct->getProdID();
        exit();
    }

    //TODO: Product update handler with old data
    if(isset($_POST['ProdNameUpdate']) && isset($_POST['ProdDescripUpdate']) &&
        isset($_POST['ProdQOHUpdate']) && isset($_POST['PRODPriceUpdate']) &&
        isset($_POST['CatalogfkUpdate']) && isset($_POST['oldProdName']) && isset($_POST['oldProdDescrip']) &&
        isset($_POST['oldQOH']) && isset($_POST['oldPRODPrice']) &&
        isset($_POST['oldCatalogfk']))
    {

        $pManagement = new ProductManagement();
        $uProduct = new Product();
        $oProduct = new Product();
        $pManagement->updateCatalog($oProduct,$uProduct);
        exit();
    }

    //Product delete
    if(isset($_POST['productDeleteID']))
    {
        echo $_POST['productDeleteID'];
        $pManagement = new productManagement();
        $id = $_POST['productDeleteID'];
        $pManagement->deleteProduct($id);
        exit();
    }

    //Update Product Fields on productlist change
    if(isset($_POST['ProductListID'])){
        $pManagement = new productManagement();
        $productResult = $pManagement->getProduct($_POST['ProductListID']);
        while ($row = mysqli_fetch_array ($productResult)){
            $arr = array('name' => $row['name'], 'desc' => $row['description'],
                'stock' => $row['stock'], 'price' => $row['price']);
            echo json_encode($arr);
        }
    }
}
?>