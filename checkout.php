<?php
require_once("./head.customer.php");
echo "<h1>Order Placed!</h1>";
 
$items =  $_SESSION['cart']; 
 
// Get the user ID 
$id = $_SESSION['id']; 
 
$sql = "INSERT INTO orders (userid, orderdetails, status) VALUES ($id, '$items', 'order placed')"; 
// echo $sql;
$sth = $DBH->prepare($sql);           
$sth->execute();   
$sth->errorInfo(); 
$_SESSION['cart']='';
echo '<meta http-equiv="refresh" content="2;URL=\'customer.php\'" />';
?>
<br>
		<div data-role="footer">
    			<h1>JelbsWorks 2016</h1>
  		</div>
</body> 
</html>