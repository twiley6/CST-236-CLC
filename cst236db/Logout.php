<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 27, 2018
Starts the session for the user that just logged in.-->


<?php
session_start();
session_destroy();
header('Location: login.php');
exit;
?>