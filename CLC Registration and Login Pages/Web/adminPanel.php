<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Feb. 2, 2018
Admin panel that manages products and catalogs.
-->
<?php
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/catalogManagement.php');
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/ProductManagement.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head> 

    <!-- Javascript for Creates, Requests, Updates, Deletes (CRUD) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>

//Catalog Create function
$(document).ready(function(){
    $("#CreateCat").click(function(){
        $.post("/CLC Registration and Login Pages/Handlers/catalogHandler.php",
        {
          catalogNameCeate: $("#catalogName").val()
        },
        function(data){
        	document.getElementById("CreateCatResult").innerHTML = $("#catalogName").val() +
            	" was successfully created!";
			//waits 3 seconds before refreshing page so user can see result
        	setTimeout(function(){location.reload();}, 3000);
            });
    });

//Catalog Update function
    $("#UpdateCat").click(function(){
        $.post("/CLC Registration and Login Pages/Handlers/catalogHandler.php",
        {
          catalogNameUpdate: $("#catalogName").val(),
          catalogIDUpdate: $("#catalogList").val(),
          oldCatalogName: $('#catalogList option:selected').text()
        },
        function(data){
        	document.getElementById("UpdateCatResult").innerHTML = $('#catalogList option:selected').text() +
        			" was successfully updated to " +
					$("#catalogName").val();
			//waits 3 seconds before refreshing page so user can see result
        	setTimeout(function(){location.reload();}, 3000);
            });
    });

//Catalog Delete function
    $("#DeleteCat").click(function(){
        $.post("/CLC Registration and Login Pages/Handlers/catalogHandler.php",
        {
        	catalogDeleteID: $("#catalogList").val()
        },
        function(data){
        	document.getElementById("DeleteCatResult").innerHTML = 
        	$('#catalogList option:selected').text() + 
            	" was successfully deleted!";
			//waits 3 seconds before refreshing page so user can see result
        	setTimeout(function(){location.reload();}, 3000);
            });
    });

//Product Create function
    $("#CreateProd").click(function(){
        $.post("/CLC Registration and Login Pages/Handlers/ProductHandler.php",
        {
          ProdNameCeate: $("#prodName").val(),
          ProdDescripCreate: $("#prodDescription").val(),
          ProdQOHCreate: $("#prodQOH").val(),
          PRODPriceCreate: $("#prodPrice").val(),
          CatalogfkCreate: $("#catalogList").val()
        },
        function(data){
        	alert("Data: " + data + "\nStatus: " + status);
        	document.getElementById("CreateProdResult").innerHTML = $("#prodName").val() +
            	" was successfully created!";
			//waits 3 seconds before refreshing page so user can see result
        	setTimeout(function(){location.reload();}, 3000);
            });
    });

//Product Delete function
    $("#DeleteProd").click(function(){
        $.post("/CLC Registration and Login Pages/Handlers/ProductHandler.php",
        {
        	productDeleteID: $("#productList").val()
        },
        function(data){
        	alert("Data: " + data + "\nStatus: " + status);
        	document.getElementById("DeleteProdResult").innerHTML = 
            	$('#productList option:selected').text() + 
                	" was successfully deleted!";
			//waits 3 seconds before refreshing page so user can see result
        	setTimeout(function(){location.reload();}, 3000);
            });
    });

//Update Product without old data
    $("#UpdateProd").click(function(){
        $.post("/CLC Registration and Login Pages/Handlers/ProductHandler.php",
        {
          ProdID: $("#productList").val(),
          ProdNameUpdate: $("#prodName").val(),
          ProdDescripUpdate: $("#prodDescription").val(),
          ProdQOHUpdate: $("#prodQOH").val(),
          ProdPriceUpdate: $("#prodPrice").val(),
          CatalogfkUpdate: $("#catalogList").val()
        },
        function(data){
        	alert("Data: " + data + "\nStatus: " + status);
        	document.getElementById("UpdateProdResult").innerHTML = 
        		$("#productList").val() + " " +
        		$('#productList option:selected').text() +
            	" was successfully updated to " +
            	$("#prodName").val() + "!";
        	
			//waits 3 seconds before refreshing page so user can see result
        	setTimeout(function(){location.reload();}, 3000);
            });
    });
});
/*TODO: Product Update function with old data
$(document).ready(function(){
    $("#UpdateProd").click(function(){
        $.post("ProductHandler.php",
        {
          oldProdName: $("#prodName").val(),
          oldProdDescrip: $("#prodDescription").val(),
          oldProdQOH: $("#prodQOH").val(),
          oldPRODPrice: $("#prodPrice").val(),
          oldCatalogfk: $("#catalogList").val()
        },
        function(data){
        	alert("Data: " + data + "\nStatus: " + status);
        	document.getElementById("CreateProdResult").innerHTML = $("#prodName").val() +
            	" was successfully created!";
			//waits 3 seconds before refreshing page so user can see result
        	setTimeout(function(){location.reload();}, 3000);
            });
    });
});*/


/*TODO: ProductList change pulls in data from productHandler as JSON
It is pulling in the data as JSON the parse is not working properly.
$(document).ready(function(){
    $("#productList").change(function(){
        $.post("ProductHandler.php",
        {
        	ProductListID: $("#productList").val()
        },
        function(data){
            //var product = $.parseJSON(data);
            
        	//alert("Data: " + data + "\nStatus: " + status);
        	//$('#prodName').val(product.name);
        	//$('#prodDescription').val(product.desc);
        	//$('#prodQOH').val(product.stock);
        	//$('#prodPrice').val(product.price);
            });
    });
});*/



</script> 

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
        <a href="cart.php" class="right"><img src="../cart.ico"></a>
        <a href="adminPanel.php" class="right">Admin Panel</a>
        <a href="catalog.php">Product Catalog</a>
        <a href="login.php" class="active">Login</a>
    </div>
</div>
<p></p>
<center><fieldset>
    <form>
       
    	<h2>Products and Catalogs Management</h2>
        <!--gives the option to only look at the catagory names one at a time and manipulate them-->
        <p><label for ="catalogList">Catalog Name:</label></p>
        <select id="catalogList" name="catalogList">
		<?php
		$cManagement = new catalogManagement();
		$result = $cManagement->getCatalogs();
    	while ($row = mysqli_fetch_array ($result)){
    	echo "<option value='".$row["catalogID"]."'>".$row["name"]."</option>";
    	}  
		?>
        </select>
        <!--gives the option to view each product one at a time and manipulate them-->
        <p><label for ="productList" >Product Name:</label></p>
        <select id="productList" name ="productList" onchange="">
		<?php 
		$pManagement = new ProductManagement();
		$result = $pManagement->getProducts();
		while ($row = mysqli_fetch_array ($result)){
			echo "<option value='".$row["productID"]."'>".$row["name"]."</option>";
		}
		?>
        </select>
    </form>
    <!--shows the name of the catalog. Blank temporarily-->
        <h4>Catalogs</h4>
        <table>
            <tr>
                <th>Name</th>
            </tr>
            <tr>
                <td><input type="text" id="catalogName"></td>
            </tr>
        </table>
    <!--these three buttons are for the catagory table only-->
    <button type="button" id="CreateCat">Add New Catalog</button>
    <p id="CreateCatResult"></p>
    <button type="button" id="UpdateCat">Update Catalog</button>
    <p id="UpdateCatResult"></p>
    <button type="button" id="DeleteCat">Delete Catalog</button>
    <p id="DeleteCatResult"></p>
    <!--shows the name, stock, and price of selected product. Blank temporarily-->
    <h4>Products</h4>
        <table>
            <tr>
                <th>Name</th>
                <th>QOH</th>
                <th>Price</th>
            </tr>
            <tr>
                <td><input type="text" id="prodName"></td>
                <td><input type="text" id="prodQOH"></td>
                <td><input type="text" id="prodPrice"></td>
            </tr>
        </table>
    <!--these buttons are for the products only-->
    <button type="button" id="CreateProd">Add New Product</button>
    <p id="CreateProdResult"></p>
    <button type="button" id="UpdateProd">Update Product</button>
    <p id="UpdateProdResult"></p>
    <button type="button" id="DeleteProd">Delete Product</button>
    <p id="DeleteProdResult"></p>
    </fieldset></center>
</body>
</html>