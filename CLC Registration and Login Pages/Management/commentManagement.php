<?php
/*CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 27, 2018
Manages comments table.
*/
require_once ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/dbcon.php');

$dbObj = new DBManagement();

Class Comment{
	
	private $commentgID;
	private $rating;
	private $description;
	private $fk_userName;
	private $fk_prodID;
	
	//get & set functions
	public function setCommentID($commentID){
		$this->commentID= $commentID;
	}
	
	public function getCommentID(){
		return $this->commentID;
	}
	
	public function setRating($rating){
		$this->rating= $rating;
	}
	
	public function getRating(){
		return $this->rating;
	}
	
	public function setDescription($description){
		$this->description= $description;
	}
	
	public function getDescription(){
		return $this->description;
	}
	
	public function setFK_userName($fk_userName){
		$this->rating= $fk_userName;
	}
	
	public function getFK_userName(){
		return $this->fk_userName;
	}
	
	public function setFK_prodID($fk_prodID){
		$this->rating= $fk_prodID;
	}
	
	public function getFK_prodID(){
		return $this->fk_prodID;
	}
	
}

Class catalogManagement{
	
	//inserts a comment
	public function createComment(Comment $nComment){
		$query = "INSERT INTO comments(rating,description,fk_userName,fk_prodID) values
              ('".$nComment->getRating().",'".$nComment->getDescription()."','".$nComment->getFK_userName().
				"',".$nComment->getFK_prodID().")";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	//gets all comments
	public function getcomments(){
		$query = "Select * from comments";
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	//gets a single comment
	public function getComment($commentID){
		$query = "Select * from comments where commentID = " . $commentID;
		return $GLOBALS['dbObj']->dbQuery($query);
	}
	//deletes a comment
	public function deleteCatalog($commentID){;
	$query = "DELETE FROM catalog WHERE catalogID = " . $commentID;
	return $GLOBALS['dbObj']->dbQuery($query);
	}	
}	
?>