<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 27, 2018
Registration page.-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
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
        <h1>Purple Team</h1>
    </div>
    <div class="navbar">
        <a href="home.html">Home</a>
        <a href="adminPanel.php" class="right">Admin Panel</a>
        <a href="cart.php" class="right"><img src="../cart.ico"></a>
        <a href="catalog.php">Product Catalog</a>
        <a href="login.php" class="active">Login</a>
    </div>
</div>
<form action = "/CLC Registration and Login Pages/Handlers/RegisterHandler.php" method="post">
    <center><h1>Registration Page</h1>
        <h2>Create Your New Account By Filling Out The Information Below</h2>

        <fieldset>

            <p><label><b>Name:</b></label>
                <input type="text" id="Name" name="Name" required></p>

            <p><label><b>Username:</b></label>
                <input type="text" id="Username" name="Username" required></p>
            <!--cannot be duplicate of another user-->

            <p><label><b>Password:</b></label>
                <input type="text" id="Password" name="Password" required></p>
                
             <p><label><b>Address:</b></label>
                <input type="text" id="Address" name="Address" required></p>  
             <label for="selectRole">Select Role:</label>
             <select id="selectRole" name="selectRole">
				<?php 
				include($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/customerManagement.php');
				$rManagement = new roleManagement();
				$result = $rManagement->getRoles();
				while ($row = mysqli_fetch_array ($result)){
				echo "<option value='".$row["role_id"]."'>".$row["role"]."</option>";
				}
				?>
			</select>           

        </fieldset>

        <h4>Once Complete, Click the Button Below</h4>

        <td colspan = "2"><input type="submit" value="Submit" /></td>
    </center>
</form>
</body>
<body>

</body>
</html>
