<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 27, 2018
DB management
-->
<?php
//set DB connection
//Gary Sundquist connection info
$con = mysqli_connect('localhost', 'admin','password', 'cst236db') or die("couldn't connect");
//Justin Hamman connection info
//Robert Nichols connection info
//Tim Wiley connection info

Class DBManagement{
	
	function getDBConnect(){
	if ($GLOBALS['con']->connect_error) {
		echo "<p>Error: Could not connect to database.<br/>
        Please try again later.</p>";
		exit();
	}
	return $GLOBALS['con'];
}
	function closeDBConnect(){
		mysqli_close($GLOBALS['con']);
	}
	
	function dbQuery($query){
		while ($queryResult = mysqli_fetch_array(mysqli_query($GLOBALS['con']), $query)){
		$queryResult[] = queryResult;
		}
		closeDBConnect();
		return $queryResult[];
	}
}
?>