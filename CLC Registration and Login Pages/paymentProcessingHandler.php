<?php
include('PaymentProcessing.php');
if(isset($_POST)){
	//Pulls products based on their catalogID
	if (isset($_POST['prodID']) && isset($_POST['qty']) && isset($_POST['price'])){
		$nSaleItem = new saleItem();
		$nSaleItem->setFkProductID($_POST['prodID']);
		$nSaleItem->setqtySold($_POST['qty']);
		$nSaleItem->setPricePerUnit($_POST['price']);
		$nSaleItem->setTotalPrice($_POST['qty']*$_POST['price']);
		$nSaleItem->setTaxAmount($_POST['qty']*$_POST['price']*.085);
		$sManagement = new saleItemManagement();
		$qResult = $sManagement->createSaleItem($nSaleItem);
		echo $qResult;
	}
}
?>