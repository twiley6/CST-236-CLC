<?php
//include('catalog.php');
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/catalogManagement.php');
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/ProductManagement.php');
//include('catalogHandler.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Your Cart</title>
<style type="text/css">
    body {
        background-color: beige;
    }
    select {
        text-align: center;
        font-weight: bold;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
        width: 30%;
    }
    fieldset {
        width: 50%;
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
        width: 25%;
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
    .navbar a.activeright {
        float: right;
        background-color: #4CAF50;
        color: white;
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
        <a href="cart.php" class="activeright"><img src="../cart.ico"></a>
        <a href="adminPanel.php" class="right">Admin Panel</a>
        <a href="catalog.php">Product Catalog</a>
        <a href="Login.php">Login</a>
    </div>
</div>
<center>
    <fieldset>
        <h1>Your Shopping Cart</h1>

        <table>
            <tr>
                <th>Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
            <tr>
                <?php
                $prodName = '';
                $selectedQuantity = 0;
                $pricePerLine = 0.00;
                echo '<td><label id="prodID">'.$prodName.'</label></td>';
                echo '<td><label id="selectedQuantity">'.$selectedQuantity.'</label></td>';
                echo '<td><label id="pricePerLine">'.$pricePerLine.'</label></td>';
                ?>
            </tr>
        </table><br>
        <table style="width: 35%">
            <tr>
                <th>Tax</th>
            </tr>
            <tr>
                <?php
                $tax = 0.00;
                echo '<td><label id="tax">'.$tax.'</label></td>';
                ?>
            </tr>
            <tr>
                <th>Total</th>
            </tr>
            <tr>
                <?php
                $totalPrice = 0.00;
                echo '<td><b><label id="totalPrice">'.$totalPrice.'</label></b></td>';
                ?>
            </tr>
        </table>
        <button type="button" id="Checkout">Proceed to Checkout</button>
        <p id="Checkout"></p>
    </fieldset>
</center>
</body>
</html>