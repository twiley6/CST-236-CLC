<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 27, 2018
Stores the information from the registration page into the database.-->


<!DOCTYPE html>
<html>
<head>
    <title>Registration Confirmation</title>
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
    <h1>TeamB Bloggers</h1>
</div>
<div class="navbar">
    <a href="home.html">Home</a>
    <a href="Admin.html" class="right">Admin Panel</a>
    <a href="createnew.html">New Blog</a>
    <a href="login.php">Login</a>
</div>
</div>
<center>
    <h1>New User Registration Confirmation</h1>

    <?php
    include('dbcon.php');
    include('customerManagement.php');

    if (!isset($_POST['Name']) || !isset($_POST['Username'])||
        !isset($_POST['Password']) || !isset($_POST['Address']) || !isset($_POST['selectRole'])){
        echo "<p><strong>You have not entered all the required details. Please try again</strong></p>";
        exit;
    }
    // create short variable names
    $nCustomer = new Customer();
    $nCustomerManagement = new customerManagement();
    $nCustomer->setName($_POST['Name']);
    $nCustomer->setUserName($_POST['Username']);
    $nCustomer->setPassword($_POST['Password']);
    $nCustomer->setAddress($_POST['Address']);
    $nCustomer->setRoleID($_POST['selectRole']);
    $dbObj = new DBManagement();

    if ($nCustomerManagement->createCustomer($nCustomer)) {
        echo  "<p>".$nCustomer->getName()." was successfully created!</p>";
    } else {
        echo "<p>I'm sorry, an error has occurred.<br/>
              User has not been created please try again. </p>" . mysqli_error($dbObj->dbConnect());
    }
    ?>
    <h4>Click the button below to return to the login page</h4>
    <p><a href="login.php"><button>Return to Login Page</button></a></p>
</center>
</body>
</html>