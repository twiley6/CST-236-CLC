<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 27, 2018
Alows for a user to log in.
-->
<?php
//set DB connection
//Gary Sundquist connection info
$con = mysqli_connect('localhost', 'admin','password', 'cst236db') or die("couldn't connect");
//Justin Hamman connection info
//Robert Nichols connection info
//Tim Wiley connection info

Class DBConnection{
	
	function getDBConnect(){
	return $GLOBALS['con'];

}
	function closeDBConnect(){
		mysqli_close($GLOBALS['con']);
	}
}
?>