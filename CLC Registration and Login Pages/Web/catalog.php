<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Robert Nichols
Jan. 30, 2018
-->
<?php
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/dbcon.php');
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/catalogManagement.php');
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/ProductManagement.php');
?>


<!DOCTYPE html>
<html>
<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>$(document).ready(function(){
            //Counts # of products
            var numOfProducts = 0;
            $("#btnProdSearchByCatalog").click(function(){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: {catalogSearch : $("#catalogList").val()},
                    url: '/CLC Registration and Login Pages/Handlers/catalogDisplayHandler.php',
                    success: function(data) {
                        //gets current ProductList tables and clears it out
                        document.getElementById("ProductList").innerHTML="";
                        numOfProducts = 0;
                        //Adds new content to ProductList table
                        $("#ProductList").append('<tr><th>Add</th><th>Name</th><th>QOH</th><th>Price</th><th>Quantity</th></tr>');
                        for (numOfProducts; numOfProducts< data.length; numOfProducts++){
                            $("#ProductList").append('<tr><td><input type="checkbox" name ="chk['+numOfProducts+']" value="'+data[numOfProducts].prodID+'"></td>'+
                                '<td><label>'+data[numOfProducts].name+'</label></td>'+
                                '<td><label>'+data[numOfProducts].stock+'</label></td>'+
                                '<td><input type="text" name="price['+numOfProducts+']" readonly value="'+data[numOfProducts].price+'"></td>'+
                                '<td><input name ="qty['+numOfProducts+']" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></input></td>'+
                                '<td><div class="stars-outer"><div class="stars-inner"></div></div></td></tr>');
                        }
                    },error: function (req, status, error) {
                        alert("/nRequest: " + req + " /nStatus: " + status + " /nError: " + error);
                    }
                },'json');
            });
            $("#btnProdSearchByName").click(function(){
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    data: {ProdSearchName : $("#prodSearchByName").val()},
                    url: '/CLC Registration and Login Pages/Handlers/catalogDisplayHandler.php',
                    success: function(data) {
                        //gets current ProductList tables and clears it out
                        document.getElementById("ProductList").innerHTML="";
                        numOfProducts = 0;
                        //Adds new content to ProductList table
                        $("#ProductList").append('<tr><th>Add</th><th>Name</th><th>QOH</th><th>Price</th><th>Quantity</th></tr>');
                        for (numOfProducts; numOfProducts< data.length; numOfProducts++){
                            $("#ProductList").append('<tr><td><input type="checkbox" name ="chk['+numOfProducts+'] value="'+data[numOfProducts].prodID+'"></td>'+
                                '<td><label>'+data[numOfProducts].name+'</label></td>'+
                                '<td><label>'+data[numOfProducts].stock+'</label></td>'+
                                '<td><input type="text" name="price['+numOfProducts+']" readonly value="'+data[numOfProducts].price+'"></td>'+
                                '<td><input name ="qty['+numOfProducts+']" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></input></td>'+
                                '<td><div class="stars-outer"><div class="stars-inner"></div></div></td></tr>');
                        }
                    },error: function (req, status, error) {
                        alert("/nRequest: " + req + " /nStatus: " + status + " /nError: " + error);
                    }
                },'json');
            });
            $("#btnAddCart").click(function(){
                for (var i=0; i<numOfProducts; i++){
                    //Checks each checkbox from loaded products to see if they are checked
                    if ($('input[name="chk['+i+']"]').is(':checked')){
                        if($("input[name='qty["+i+"]']").val() > 0){
                            //ajax call to paymentProcessing class to create sale item
                            alert($("input[name='chk["+i+"]']").val());
                            alert($("input[name='qty["+i+"]']").val());
                            alert($("input[name='price["+i+"]']").val());
                            $.post("paymentProcessingHandler.php",
                                {
                                    prodID: $("input[name='chk["+i+"]']").val(),
                                    qty: $("input[name='qty["+i+"]']").val(),
                                    price: $("input[name='price["+i+"]']").val()
                                },
                                function(data){
                                    alert(data);
                                    document.getElementById("createSaleItem").innerHTML = "item(s) have been added to your cart!";
                                });
                        }else{
                            //Error handling for missing quantity
                            alert("please enter a quantity for all of your checked items");
                        }
                    }
                }
            });

        });

    </script>

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
        .stars-outer {
            display: inline-block;
            position: relative;
            font-family: FontAwesome;
        }

        .stars-outer::before {
            content: "\f006 \f006 \f006 \f006 \f006";
        }

        .stars-inner {
            position: absolute;
            top: 0;
            left: 0;
            white-space: nowrap;
            overflow: hidden;
            width: 0;
        }

        .stars-inner::before {
            content: "\f005 \f005 \f005 \f005 \f005";
            color: #f8ce0b;
        }
    </style>
</head>
<body>
<div class="header">
    <div class="logo">
        <h1>Purple Team</h1>
    </div>
    <div class="navbar">
        <a href="cart.php" class="right"><img src="../cart.ico"></a>
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

            <input type='button' id="btnProdSearchByCatalog" value='Search by Product Name'>
            <h3>or search for a product here</h3>
            <p><input type="text" id="prodSearchByName"></input></p>
            <input type="button" id="btnProdSearchByName" value='Search by Product Name'>

            <!--shows the name, description, stock, and price of selected product. Blank temporarily-->
            <h4>Products</h4>
            <table id ="ProductList">
                <tr>
                    <th>Add</th>
                    <th>Name</th>
                    <th>QOH</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Rating</th>
                </tr>
            </table>
            <button type="button" id="btnAddCart">Add Selected To Cart</button>
            <p id="addCart"></p>
            <p id="createSaleItem"></p>
        </fieldset>
    </form>
</center>

</body>
</html>