<?php
	require_once("./head.customer.php");
	echo "<h1>Customer Page</h1>";

	echo "<br>"; 
?>
	<div data-role="content">
	<a href="products.php" data-role="button"  data-transition="flip">View Products</a>
	<a href="editCustomers.php" data-role="button"  data-transition="flip">Edit Details</a>
	<a href="viewOrders.php" data-role="button"  data-transition="flip">View Previous Orders/Order Status</a>
	<a href="viewCart.php" data-role="button"  data-transition="flip">View Current Cart</a>
	<a href="logout.php" data-role="button"  data-transition="flip">Logout</a>
	
	<br> 
	</div> 
	<div data-role="footer">
    			<h1>JelbsWorks 2016</h1>
  		</div>
		
	</body>
</html>