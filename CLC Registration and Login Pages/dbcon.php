<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 27, 2018
DB management
-->
<?php

Class DBManagement{
	
	//set DB connection
	//Gary Sundquist connection info
	private $con = mysqli_connect('localhost', 'admin','password', 'cst236db') or die("couldn't connect");
	//Justin Hamman connection info
	//Robert Nichols connection info
	//Tim Wiley connection info
	
	
	//function to get dbconnection	
	public function dbConnect(){
		if (this.$con->connect_error) {
		echo "<p>Error processing SQL transaction. " +
         "Error: </p>" .this.$con->error;
		exit();
	}
	return $con;
}
	
	//function to close db connection
	public function dbClose(){
		mysqli_close(dbConnect());
	}
	
	//function to get multiple rows back from the DB
	public function dbArrayResult($query){
		while ($queryResult = mysqli_fetch_array(dbConnect(), $query)){
		$queryResult[] = queryResult;
		}
		dbClose();
		return $queryResult[];
	}
	
	//function to return array of single result
	public function dbSingleResult($query){
	$singleRowResult = mysql_query(dbConnect(), $query);
	return mysql_fetch_row($singleRowResult);
	}
	
	//function for insert
	public function dbInsert($query){
		mysqli_query(dbConnect(), $query);
	}
	

	//function to delete from db
	public function dbDelete($query){
		mysqli_query(dbConnect(), $query);
	}
	
	//function to update checks old data for changes
	public function dbUpdate($oldDataQuery,$newDataQuery){
		/*if old data exists process new data request else 
		echo error */
		$oldQueryResult = mysql_query($dbConnect(), $oldDataQuery);
		if ($oldQueryResult){
			mysql_query($dbConnect(), $newDataQuery);
		}else{
			echo "Could not execute query: " .mysql_error();
		}
	}
}
?>