<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Feb. 6, 2018
Manages customers.
-->

<?php
require_once 'dbcon.php';
$dbObj = new DBManagement();

//Customer class
class Customer{
	private $name;
	private $password;
	private $userName;
	private $address;
	private $roleID;
	private $fk_AcctNumber;
	
	//get set functions
	function setRoleID($roleID){
		$this->roleID = $roleID;
	}
	function setAddress($address){
		$this->address = $address;
	}
	function setName($name){
		$this->name = $name;
	}
	function setPassword($password){
		$this->password = $password;
	}
	function setUserName($userName){
		$this->userName = $userName;
	}	
	function setFK_AcctNumber($fk_AcctNumber){
		$this->fk_AcctNumber = $fk_AcctNumber;
	}
	function getName(){
		return $this->name;
	}
	function getPassword(){
		return $this->password;
	}
	function getUserName(){
		return $this->userName;
	}	
	function getAddress(){
		return $this->address;
	}	
	function getRoleID(){
		return $this->roleID;
	}	
	function getFK_AcctNumber(){
		return $this->fk_AcctNumber;
	}
}

//Bank class
class Bank{
	private $acc_Number;
	private $fk_UserName;
	private $cardType;
	private $balance;
	
	//get set functions
	function setAcc_Number($acc_Number){
		$this->acc_Number = $acc_Number;
	}
	function setFkUserName($fk_UserName){
		$this->fk_UserName= $fk_UserName;
	}
	
	function setCardType($cardType){
		$this->cardType= $cardType;
	}
	
	function setBalance($balance){
		$this->balance= $balance;
	}
	
	function getAcc_Number(){
		return $this->acc_Number;
	}
	function getFkUserName(){
		return $this->fk_UserName;
	}
	
	function getCardType(){
		return $this->cardType;
	}
	
	function getBalance(){
		return $this->balance;
	}
	
}

//Role class
class role{
	private $role_ID;
	private $role;
	
	//get set functions
	function setRole_ID($role_ID){
		$this->role_ID= $role_ID;
	}
	function getRole_ID(){
		return $this->role_ID;
	}
	function setRole($role){
		$this->role = $role;
	}
	function getRole(){
		return $this->role;
	}		
}

//Customer Management class
class customerManagement{		
		
		//inserts a customer
		public function createCustomer(Customer $nCustomer){
			$query = "INSERT INTO users(name,userName,password,fk_role_id,address) values
              ('".$nCustomer->getName()."','".$nCustomer->getUserName()."','".
					$nCustomer->getPassword()."',".$nCustomer->getRoleID().",'".
					$nCustomer->getAddress()."')";
			return $GLOBALS['dbObj']->dbQuery($query);
		}
		
		//Adds a bank account to a customer
		public function insertBankAccount($acctNumber){
			$query = "UPDATE users SET fk_acct_Number = ". $acctNumber;
              return $GLOBALS['dbObj']->dbQuery($query);
		}
		
		//gets all customers
		public function getCustomers(){
			$query = "Select * from users";
			return $GLOBALS['dbObj']->dbQuery($query);
		}
		//gets a single customer
		public function getCustomer($userName){
			$query = "Select * from users where userName = " . $userName;
			return $GLOBALS['dbObj']->dbQuery($query);
		}
		//deletes a customer
		public function deleteCustomer($userName){;
		$query = "DELETE FROM users WHERE userName = " . $userName;
		return $GLOBALS['dbObj']->dbQuery($query);
		}
		//updates a customer
		public function updateCustomer(Customer $oCustomer, Customer $nCustomer){
			
			$oldQuery = "SELECT * FROM users WHERE ". 
			" name=".$oCustomer->getName() ."' AND password= '". $oCustomer->getPassword().
			" ' AND userName= '". $oCustomer->getUserName(). "' AND fk_role_id=". $oCustomer->getRoleID().
			" AND address='". $oCustomer->getAddress()."'";
			
			$newQuery = "UPDATE users SET ".
			"name='".$nCustomer->getName() ."', password= '". $nCustomer->getPassword().
			" ', userName= '". $nCustomer->getUserName(). "', fk_role_id=". $nCustomer->getRoleID().
			", address='".$nCustomer->getAddress()."'";
			
			return $GLOBALS['dbObj']->dbUpdate($oldQuery,$newQuery);
		}		
}

//Role Management class
class roleManagement{
	//Returns a role
	public function getRole($roleID){
		$query = "Select * from role where role_id = " . $roleID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}	
	//returns all roles
	public function getRoles(){
		$query = "Select * from role";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	//Creates a role
	public function createRole($roleName){
		$query ="Insert INTO role(role) VALUES('".$roleName."')";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	//Deletes a role
	public function deleteRole($roleID){;
	$query = "DELETE FROM role WHERE urole_id = " . $roleID;
	return $GLOBALS['dbObj']->dbQuery($query);
	}	
	//Updates a role
	public function updateRole(role $oRole, $roleName){
		$oldQuery = "Select * from role Where role = '".$oRole->getRole()."'";
		$newQuery = "Update role SET role='".$roleName.
					"' Where role_id=".$oRole->getRole_ID();		
		return $GLOBALS['dbObj']->dbUpdate($oldQuery,$newQuery);
	}
}

//Bank management class
class bankManagement{
	//Returns a bank account
	public function getBankAccount($acc_Number){
		$query = "Select * from bank where acct_number = " . $acc_Number;
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	//returns all bank accounts
	public function getBankAccounts(){
		$query = "Select * from bank";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	//Creates a bank account
	public function createBankAccount(Bank $nBank){
		$query ="Insert INTO bank(fk_userName,card_type,balance) VALUES(".$nBank->getFkUserName().
		",'".$nBank->getCardType()."',".$nBank->getBalance().")";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	//Deletes a bank account
	public function deleteBankAccount($accID){;
	$query = "DELETE FROM bank WHERE acct_number = " . $accID;
	return $GLOBALS['dbObj']->dbQuery($query);
	}
	//Updates a bank account
	public function updateBankAccount(Bank $oBank, Bank $nBank){
		$oldQuery = "Select * from bank Where acct_number = ".$oBank->getAcc_Number()
		." AND fk_userName=".$oBank->getFkUserName()." AND balance=".$oBank->getBalance().
		" AND card_type='".$oBank->getCardType()."'";
		$newQuery = "Update bank SET fk_userName=".$nBank->getFkUserName().", card_type='".
				$nBank->getCardType()."', balance=".$nBank->getBalance().
				" Where acct_number=".$oBank->getAcc_Number();
		return $GLOBALS['dbObj']->dbUpdate($oldQuery,$newQuery);
	}
}
?>