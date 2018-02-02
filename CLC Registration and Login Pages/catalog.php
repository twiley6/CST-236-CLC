<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 30, 2018
-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Catalog</title>
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
        <a href="catalog.html">Product Catalog</a>
        <a href="login.php" class="active">Login</a>
    </div>
</div>

</body>
</html>