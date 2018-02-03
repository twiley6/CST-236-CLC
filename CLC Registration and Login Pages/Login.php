<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 27, 2018
Alows for a user to log in.
-->
<?php
require_once('dbcon.php');
session_start();

if (isset($_POST['Username']) && isset($_POST['Password']))
{
    // if the user has just tried to log in
    $user = $_POST['Username'];
    $pass = $_POST['Password'];
    $dbObj = new DBManagement();

    $query = mysqli_query($dbObj->dbConnect(),"select * from users where userName='".$user."' and password='".$pass."'");
    $result = mysqli_fetch_array($query);
    $dbObj->dbClose();
    
    if ($result>0)
    {
// if they are in the database register the user
        $_SESSION['valid_user'] = $user;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <style type="text/css">
        body {
            background-color: beige;
        }
        fieldset {
            width: 30%;
            border: 2px solid #cccccc;
        }

        label {
            width: 75px;
            float: left;
            text-align: center;
            font-weight: bold;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }

        input {
            border: 1px solid #000;
            padding: 3px;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
            position: static;
            bottom: 0;
            width: 100%;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .navbar a.active {
            background-color: #4CAF50;
            color: white;
        }

        .navbar a.right {
            float: right;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="logo">
        <h1>Purple Team</h1>
    </div>
    <div class="navbar">
        <a href="home.html">Home</a>
        <a href="adminPanel.php" class="right">Admin Panel</a>
        <a href="catalog.html">Product Catalog</a>
        <a href="login.php" class="active">Login</a>
    </div>
</div>
<center>

    <?php
    if (isset($_SESSION['valid_user']))
    {
        echo '<fieldset>';
        echo '<p>You are logged in as: '.$_SESSION['valid_user'].' <br />';
        echo '<a href="logout.php">Log out</a></p>';
        echo '<a href="userspage.php">Continue to your Dashboard</a>';
    }
    else
    {
        if (!isset($user))
        {
            //Page when they click logout
            echo '<fieldset>';
            echo '<legend>Sucessfully logged out.</legend>';
        }
        else
        {
            /* please enter username and password prompt if they user 
             * trys to submit without a username and or password
             */
            echo '<fieldset>';
            echo '<legend>Please enter a valid username and password</legend>';
        }

        //Login form fields
        echo '<form action="login.php" method="post">';
        echo '<fieldset>';
        echo '<legend>Login Now!</legend>';
        echo '<p><label for="Username">Username:</label>';
        echo '<input type="text" name="Username" placeholder="Username" size="30"/></p>';
        echo '<p><label for="Password">Password:</label>';
        echo '<input type="Password" name="Password" placeholder="Password" size="30"/></p>';
        echo '</fieldset>';
        echo '<button type="Submit" name="Login">Login</button>';
        echo 'New? <a href="registerpage.html">Register By Clicking Here!</a>';
        echo '</form>';

    }
    echo '</fieldset>';

    ?>

</center>

</body>
</html>