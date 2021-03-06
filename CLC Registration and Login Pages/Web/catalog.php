<!--CST-236 CLC-Registration and Login Pages
Tim Wiley
Gary Sundquist
Justin Hamman
Robert Nichols
Jan. 30, 2018
-->
<?php
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/dbcon.php');
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/catalogManagement.php');
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/ProductManagement.php');
include ($_SERVER['DOCUMENT_ROOT'].'/CLC Registration and Login Pages/Management/PaymentProcessing.php');
session_start();
?>


<!DOCTYPE html>
<html>
<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
	
	<?php 
	if(!$_SESSION['valid_user']){
		$_SESSION['valid_user'] = "";
	}
	?>
	
	//Counts # of products
	var numOfProducts = 0;
   $("#btnProdSearchByCatalog").click(function(){
    	$.ajax({
    		  type: "POST",
    		  dataType: "json",
    		  data: {catalogSearch : $("#catalogList").val()},
    		  url: '/CLC Registration and Login Pages/Handlers/CatalogDisplayHandler.php',
    		  success: function(data) {
        		//gets current ProductList tables and clears it out
    			document.getElementById("ProductList").innerHTML="";
    			numOfProducts = 0;
        		//Adds new content to ProductList table
        		/*$("#ProductList").append('<tr><th>Add</th><th>Name</th><th>QOH</th><th>Price</th><th>Quantity</th></tr>');
    			for (numOfProducts; numOfProducts< data.length; numOfProducts++){
    		    $("#ProductList").append('<tr><td><input type="checkbox" name ="chk['+numOfProducts+']" value="'+data[numOfProducts].prodID+'"></td>'+
              	'<td><label>'+data[numOfProducts].name+'</label></td>'+
               	'<td><label>'+data[numOfProducts].stock+'</label></td>'+
               	'<td><input type="text" name="price['+numOfProducts+']" readonly value="'+data[numOfProducts].price+'"></input></td>'+
               	'<td><input name ="qty['+numOfProducts+']" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></input></td></tr>');*/
               	$("#ProductList").append('<tr><th>Add</th><th>Name</th><th>QOH</th><th>Price</th><th>Quantity</th><th>Reviews</th></tr>');
               	for (numOfProducts; numOfProducts< data.length; numOfProducts++){
               	    $("#ProductList").append('<tr><td><input type="checkbox" name ="chk['+numOfProducts+']" value="'+data[numOfProducts].prodID+'"></td>'+
               	        '<td><label>'+data[numOfProducts].name+'</label></td>'+
               	        '<td><label>'+data[numOfProducts].stock+'</label></td>'+
               	        '<td><input type="text" name="price['+numOfProducts+']" readonly value="'+data[numOfProducts].price+'"></input></td>'+
               	        '<td><input name ="qty['+numOfProducts+']" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></input></td>'+
               	        '<td><button class="link" style="width: auto;" id="comments'+data[numOfProducts].prodID+'">View Comments</button></td></tr>');
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
                   	'<td><input type="text" name="price['+numOfProducts+']" readonly value="'+data[numOfProducts].price+'"></input></td>'+
                   	'<td><input name ="qty['+numOfProducts+']" type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></input></td></tr>');
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
				 $.post("/CLC Registration and Login Pages/Handlers/paymentProcessingHandler.php",
					        {
				        	  userName: "<?php echo $_SESSION['valid_user']?>",
					          prodID: $("input[name='chk["+i+"]']").val(),
					          qty: $("input[name='qty["+i+"]']").val(),
					          price: $("input[name='price["+i+"]']").val() 
					        },
					        function(data){
					        	document.getElementById("createSaleItem").innerHTML = "item(s) have been added to your cart!";
					            });
			}else{
				//Error handling for missing quantity
				alert("please enter a quantity for all of your checked items");
			}
		}else{
			//Error handling for add item not checked
			alert("please make sure that the add checkbox is checked for any items you wish to add to your cart.");
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
        
        #Comments{
        	visibility: hidden;
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
        <a href="catalog.php" class="active">Product Catalog</a>
        <a href="Login.php">Login</a>
    </div>
</div>
	<div style="float: left; width: auto;">
    	<form>
    		<fieldset style="width: 800px">
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
                	<th>Reviews</th>
           	   </tr>
        	</table>
        	<button type="button" id="btnAddCart">Add Selected To Cart</button>
        	<p id="addCart"></p>
			<p id="createSaleItem"></p>
    		</fieldset>
    	</form>
    </div>
    
    <div style="float: right; width: auto;">
		<fieldset>
			<!--  looks up the last item the user purchased and shows an image related to it -->
			<?php 
				$saleItemManagement = new saleItemManagement();
			 	$Result = $saleItemManagement->getLastSaleItemAndProductID($_SESSION['valid_user']);
			 	$value = mysqli_fetch_object($Result);
			 	echo '<p>Here is something you may be interested in:</p></br>';
			 	switch($value->fk_productID){
			 		
			 		case 1:
			 		case 3:
			 			echo '<img src="../Ad_Images/Shoe1.jpeg" height="250" width="250"/>';
			 			break;
			 		
			 		case 4:
			 		case 5:
			 			echo '<img src="../Ad_Images/Shoe2.jpeg" height="250" width="250"/>';
			 			break;
			 		
			 		case 6:
			 		case 7:
			 		case 8:
			 			echo '<img src="../Ad_Images/Shoe3.jpeg" height="250" width="250"/>';
			 			break;
			 		
			 		default:
			 			switch(rand(1,3)){
			 		case 1:
			 			echo '<img src="../Ad_Images/Shoe1.jpeg" height="250" width="250"/>';
			 			break;	
			 		case 2:
			 			echo '<img src="../Ad_Images/Shoe2.jpeg" height="250" width="250"/>';
			 			break;
			 		case 3:
			 			echo '<img src="../Ad_Images/Shoe3.jpeg" height="250" width="250"/>';
			 			break;
			 		}
			 	}
			?>
		</fieldset>
	</div>
	
	<table id="Comments">
    <tr>
        <th>Comment</th>
        <th>Rating</th>
    </tr>
    <?php 
    $cManagement = new commentManagement();
    $result = $cManagement->getComment();
    while ($row = mysqli_fetch_array ($result)){
    	echo "<td><label>".$row["CommentID"]."</label></td>";
    }
    ?>
	</table>
	
</body>
</html>