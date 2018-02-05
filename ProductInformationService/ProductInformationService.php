<?php

class ProductInformationService{
	/*receives product info as json and returns a sample product 
	description as a string*/
	public function getProductInformation($json){

		//decodes json into an object
		$prod = json_decode($json);
		return $prod[0]->name + " is an amazing product! For the low price of " +
         $prod[0]->price + " it can do anything!";
	}
}
?>