<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Feb. 6, 2018
Manages payment proccessing.
-->

<?php
require_once 'dbcon.php';
$dbObj = new DBManagement();

//Transaction class
class transaction{
	private $transaction_ID;
	private $date_Time;
	private $sale_Amount;
	private $tax_Amount;
	private $fk_UserID;
	
	//get set functions
	function setTransaction_ID($transaction_ID){
		$this->transaction_ID= $transaction_ID;
	}
	function getTransaction_ID(){
		return $this->transaction_ID;
	}
	
	function setDate_Time($date_Time){
		$this->date_Time= $date_Time;
	}
	
	function getDate_Time(){
		return $this->date_Time;
	}
	
	function setSale_Amount(){
		$this->sale_Amount = $sale_Amount;
	}
	function getSale_Amount(){
		return $this->sale_Amount;
	}
	
	function setTax_Amount($tax_Amount){
		$this->tax_Amount = $tax_Amount;
	}
	
	function getTax_Amount(){
		return $this->tax_Amount;
	}
	
	function setFk_UserName($fk_UserID){
		$this->fk_UserName= $fk_UserID;
	}
	
	function getFk_UserID(){
		return $this->fk_UserID;
	}
}

//Transaction Management class	
class transactionManagement{
		//Returns a transaction
		public function getTransaction($transactionID){
			$query = "Select * from transactions where transaction_id = " . $transactionID;
			return $GLOBALS['dbObj']->dbQuery($query);
		}
		//returns all transactions
		public function getTransactions(){
			$query = "Select * from transactions";
			return $GLOBALS['dbObj']->dbQuery($query);
		}
		//Creates a transaction
		public function createTransaction(transaction $nTransaction){
			$query ="Insert INTO transactions(transaction_id,date_time,sale_amount,tax_amount,fk_userID)".
			 " VALUES(".$nTransaction->getTransaction_ID().",".$nTransaction->getDate_Time().
			",".$nTransaction->getSale_Amount().",".$nTransaction->getTax_Amount().",". $nTransaction->getFk_UserID().
			")";
			return $GLOBALS['dbObj']->dbQuery($query);
		}
		//Deletes a transaction
		public function deleteTransaction($transID){;
		$query = "DELETE FROM transactions WHERE transaction_id = " . $transID;
		return $GLOBALS['dbObj']->dbQuery($query);
		}
		//Updates a bank account
		public function updateTransaction(transaction $oTransaction, transaction $nTransaction){
			$oldQuery = "Select * from transactions Where transaction_id = ".$oTransaction->getTransaction_ID()
			." AND date_time=".$oTransaction->getDate_Time()." AND sale_amount=".$oTransaction->getSale_Amount().
			" AND tax_amount=".$oTransaction->getTax_Amount()." AND fk_userID=".$oTransaction->getFk_UserID();
			$newQuery = "Update transactions SET date_time=".
					$nTransaction->getDate_Time().", sale_amount=".$nTransaction->getSale_Amount().
					"tax_amount=".$nTransaction->getTax_Amount().", fk_userID=".$nTransaction->getFk_UserID().
					" WHERE transaction_id=".$nTransaction->getTransaction_ID();
					return $GLOBALS['dbObj']->dbUpdate($oldQuery,$newQuery);
		}
	}
	
//saleItem class
class saleItem{
		private $saleID;
		private $qtySold;
		private $pricePerUnit;
		private $totalPrice;
		private $taxAmount;
		private $fkTransactionID;
		private $fkProductID;
				
		//getters and setters
		function setSaleID($saleID){
			$this->saleID=$saleID;
		}
		function setqtySold($qtySold){
			$this->qtySold=$qtySold;
		}
		function setPricePerUnit($pricePerUnit){
			$this->pricePerUnit=$pricePerUnit;
		}
		function setTotalPrice($totalPrice){
			$this->totalPrice=$totalPrice;
		}
		function setTaxAmount($taxAmount){
			$this->taxAmount=$taxAmount;
		}
		function setFkTransactionID($fkTransactionID){
			$this->fkTransactionID=$fkTransactionID;
		}
		function setFkProductID($fkProductID){
			$this->fkProductID=$fkProductID;
		}
		function getSaleID(){
			return $this->saleID;
		}
		function getQtySold(){
			return $this->qtySold;
		}
		function getPricePerUnit(){
			return $this->pricePerUnit;
		}
		function getTotalPrice(){
			return $this->totalPrice;
		}
		function getTaxAmount(){
			return $this->taxAmount;
		}
		function getFkTransactionID(){
			return $this->fkTransactionID;
		}
		function getFkProductID(){
			return $this->fkProductID;
		}
		
	}
	
	class saleItemManagement{
		//Returns a sale item
		public function getSaleItem($saleID){
			$query = "Select * from sale_item where sale_id = " . $saleID;
			return $GLOBALS['dbObj']->dbQuery($query);
		}
		//returns all sale items
		public function getSaleItems(){
			$query = "Select * from sale_item";
			return $GLOBALS['dbObj']->dbQuery($query);
		}
		//Creates a sale item
		public function createSaleItem(saleItem $nSaleItem){
			$query ="Insert INTO sale_item(qty_sold,price_per_unit,total_price,tax_amount,fk_transaction_id,fk_productID) 
			VALUES(".$nSaleItem->getQtySold().",".$nSaleItem->getPricePerUnit().",".$nSaleItem->getTotalPrice().",".
			$nSaleItem->getTaxAmount().",".$nSaleItem->getFkTransactionID().",".$nSaleItem->getFkProductID()
			.")";
			return $GLOBALS['dbObj']->dbQuery($query);
		}
		//Deletes a sale item
		public function deleteSaleItem($saleID){;
		$query = "DELETE FROM sale_item WHERE sale_id = " . $saleID;
		return $GLOBALS['dbObj']->dbQuery($query);
		}
		//Updates a sale item
		public function updateSaleItem(saleItem $oSaleItem, saleItem $nSaleItem){
			$oldQuery = "Select * from sale_item Where sale_id = ".$oSaleItem->getSaleID()
			." AND qty_sold=".$oSaleItem->getQtySold()." AND price_per_unit=".$oSaleItem->getPricePerUnit().
			" AND total_price=".$oSaleItem->getTotalPrice()." AND tax_amount=".$oSaleItem->getTaxAmount().
			" AND fk_transaction_id=".$oSaleItem->getFkTransactionID()." AND fk_productID=".$oSaleItem->getFkProductID();
			
			$newQuery = "Update sale_item SET qty_sold=".$nSaleItem->getQtySold().", price_per_unit='".
					$nSaleItem->getPricePerUnit()."', total_price=".$nSaleItem->getTotalPrice().", tax_amount=". $nSaleItem->getTaxAmount().
					", fk_transaction_id=".$nSaleItem->getFkTransactionID().", fk_productionID=".$nSaleItem->getFkProductID().
					"' Where sale_id=".$oSaleItem->getSaleID();
			
					return $GLOBALS['dbObj']->dbUpdate($oldQuery,$newQuery);
		}
	}
	
	
?>