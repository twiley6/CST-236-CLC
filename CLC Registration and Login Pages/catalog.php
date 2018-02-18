<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 30, 2018
-->
<?php
include 'dbcon.php';
include 'catalogManagement.php';
include 'ProductManagement.php';
session_start();
?>


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
            text-align: center;
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
            width: 45%;
        }
        select {
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
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: center;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
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
        <a href="cart.php" class="right"><img src="cart.ico"></a>
        <a href="adminPanel.php" class="right">Admin Panel</a>
        <a href="catalog.php" class="active">Product Catalog</a>
        <a href="Login.php">Login</a>
    </div>
</div>

<center>
    <form>
    <fieldset>
        <h1>Purple Team Shoes</h1>
        <h3>Select the catalog you'd like to view</h3>
        <select id="catalogList" name="catalogList" onchange="">
            <?php
            $cManagement = new catalogManagement();
            $result = $cManagement->getCatalogs();
            while ($row = mysqli_fetch_array ($result)){
                echo "<option value='".$row["catalogID"]."'>".$row["name"]."</option>";
            }
            ?>
        </select>
        <h3>or search for a product here</h3>
        <p><input type="search" id="prodSearch"></p>
        <input type="submit" value="Search">

        <!--shows the name, description, stock, and price of selected product. Blank temporarily-->
        <h4>Products</h4>
        <table>
            <tr>
                <th>Add</th>
                <th>Name</th>
                <th>QOH</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
            <tr>
                <td><input type="checkbox" id="prodID"</td>
                <td><input type="text" id="prodName"></td>
                <td><input type="text" id="prodQOH"></td>
                <td><input type="text" id="prodPrice"></td>
                <td>
                    <select id="quantity">
                        <option selected>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><input type="checkbox" id="prodID"</td>
                <td><input type="text" id="prodName"></td>
                <td><input type="text" id="prodQOH"></td>
                <td><input type="text" id="prodPrice"></td>
                <td>
                    <select id="quantity">
                        <option selected>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </td>            </tr>
            <tr>
                <td><input type="checkbox" id="prodID"</td>
                <td><input type="text" id="prodName"></td>
                <td><input type="text" id="prodQOH"></td>
                <td><input type="text" id="prodPrice"></td>
                <td>
                    <select id="quantity">
                        <option selected>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </td>            </tr>
            <tr>
                <td><input type="checkbox" id="prodID"</td>
                <td><input type="text" id="prodName"></td>
                <td><input type="text" id="prodQOH"></td>
                <td><input type="text" id="prodPrice"></td>
                <td>
                    <select id="quantity">
                        <option selected>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </td>            </tr>
            <tr>
                <td><input type="checkbox" id="prodID"</td>
                <td><input type="text" id="prodName"></td>
                <td><input type="text" id="prodQOH"></td>
                <td><input type="text" id="prodPrice"></td>
                <td>
                    <select id="quantity">
                        <option selected>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </td>            </tr>
            <tr>
                <td><input type="checkbox" id="prodID"</td>
                <td><input type="text" id="prodName"></td>
                <td><input type="text" id="prodQOH"></td>
                <td><input type="text" id="prodPrice"></td>
                <td>
                    <select id="quantity">
                        <option selected>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </td>            </tr>
            <tr>
                <td><input type="checkbox" id="prodID"</td>
                <td><input type="text" id="prodName"></td>
                <td><input type="text" id="prodQOH"></td>
                <td><input type="text" id="prodPrice"></td>
                <td>
                    <select id="quantity">
                        <option selected>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6</option>
                        <option>7</option>
                        <option>8</option>
                        <option>9</option>
                        <option>10</option>
                    </select>
                </td>            </tr>
        </table>

        <button type="button" id="addCart">Add Selected To Cart</button>
        <p id="addCart"></p>

    </fieldset>
    </form>
</center>

</body>
</html>