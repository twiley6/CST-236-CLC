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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	
   $("#btnProdSearchByCatalog").click(function(){
    	$.ajax({
    		  type: "POST",
    		  dataType: "json",
    		  data: {catalogSearch : $("#catalogList").val()},
    		  url: 'catalogDisplayHandler.php',
    		  success: function(data) {
        		//gets current ProductList tables and clears it out
    			document.getElementById("ProductList").innerHTML="";
        		//Adds new content to ProductList table
        		$("#ProductList").append('<tr><th>Add</th><th>Name</th><th>QOH</th><th>Price</th><th>Quantity</th></tr>');
    			for (var i = 0; i< data.length; i++){
    		    $("#ProductList").append('<tr><td><input type="checkbox" id ="'+data[i].prodID+'"></td>'+
              	'<td><label>'+data[i].name+'</label></td>'+
               	'<td><label>'+data[i].stock+'</label></td>'+
               	'<td><label>'+data[i].price+'</label></td>'+
               	'<td><input id ="qtyItem'+i+'" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></input></td></tr>');
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
  		  url: 'catalogDisplayHandler.php',
  		  success: function(data) {
      			//gets current ProductList tables and clears it out
  				document.getElementById("ProductList").innerHTML="";
  				//Adds new content to ProductList table
  				$("#ProductList").append('<tr><th>Add</th><th>Name</th><th>QOH</th><th>Price</th><th>Quantity</th></tr>');
      			for (var i = 0; i< data.length; i++){
        		    $("#ProductList").append('<tr><td><input type="checkbox" id ="'+data[i].prodID+'"></td>'+
                  	'<td><label>'+data[i].name+'</label></td>'+
                   	'<td><label>'+data[i].stock+'</label></td>'+
                   	'<td><label>'+data[i].price+'</label></td>'+
                   	'<td><input id ="qtyItem'+i+'" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></input></td></tr>');
        			}
  	  		  },error: function (req, status, error) {
                alert("/nRequest: " + req + " /nStatus: " + status + " /nError: " + error);  
            }
  		},'json');
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
            </tr>
        </table>

        <button type="button" id="addCart">Add Selected To Cart</button>
        <p id="addCart"></p>

    </fieldset>
    </form>
</center>

</body>
</html>