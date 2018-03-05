<?php
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/PaymentProcessing.php');
if(isset($_POST)){
	//Pulls products based on their catalogID
	if (isset($_POST['prodID']) && isset($_POST['qty']) && isset($_POST['price']) &&
			isset($_POST['userName'])){
		$nSaleItem = new saleItem();
		$nSaleItem->setFkProductID($_POST['prodID']);
		$nSaleItem->setqtySold($_POST['qty']);
		$nSaleItem->setPricePerUnit($_POST['price']);
		$nSaleItem->setTotalPrice($_POST['qty']*$_POST['price']);
		$nSaleItem->setTaxAmount($_POST['qty']*$_POST['price']*.085);
		$nSaleItem->setFk_saleUserName($_POST['userName']);
		$sManagement = new saleItemManagement();
		$qResult = $sManagement->createSaleItem($nSaleItem);
		echo $qResult;
	}
	//Creates new transaction in transaction table and assigns transactionID to sale items
	if (isset($_POST['saleAmount']) && isset($_POST['taxAmount']) && isset($_POST['userName'])){
		$nTransaction = new transaction();
		$tManagement = new transactionManagement();
		$nTransaction->setFk_UserName($_POST['userName']);
		$nTransaction->setSale_Amount($_POST['saleAmount']);
		$nTransaction->setTax_Amount($_POST['taxAmount']);
		$qResult = $tManagement->createTransaction($nTransaction);
		echo $qResult;
		//If the transaction was successfully created add transaction ID to saleitems
		if ($qResult == 1){
			$tID = mysqli_fetch_assoc($tManagement->getLastTransactionForUser($_POST['userName']));
			$tID =	$tID["MAX(transaction_id)"];
			$sManagement = new saleItemManagement();
			$saleItems = $sManagement->getSaleItemsForUserWithoutTransactionID($_POST['userName']);
			while ($row = mysqli_fetch_array ($saleItems)){
				$sManagement->setSaleItemTransactionID($tID, $row['sale_id']);
			}
		}
		
	}
}
?>