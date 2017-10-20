<?php
require_once("./head.customer.php");

echo "<h1>Cart</h1>";

function getItemInfo($p_ID, $DBH){ 

	$q = $DBH->prepare("SELECT * FROM products WHERE p_ID= :p_ID"); 
	$q->bindValue(':p_ID', $p_ID); 
	$q->execute();
	
	return ($q->fetch(PDO::FETCH_ASSOC) );
}
$items = trim($_SESSION['cart']); //remove whitespaces from begining (and end) 
if ($items != "") {
	echo "Items in cart:";
	$tok = explode(" ", $items);
	echo '<table>'; 
	echo '<tr>';
	echo '<td> ID </td>'; 
	echo '<td> Name </td>'; 
	echo '<td> Description </td>'; 
	echo '<td> Price </td>'; 
	echo '</tr>';
	foreach($tok as $item) { 
		$row = getItemInfo($item, $DBH);
		echo '<tr>';
		echo '<td>' . $row['p_ID'] . '</td>';
		echo '<td>' . $row['p_name'] . '</td>';
		echo '<td>' . $row['p_description'] . '</td>';
		echo '<td>€' . $row['p_price'] . '</td>';
		echo '</tr>';
	}
	echo '</table>'; 
	
}
?>
<a href="checkout.php" data-role="button" data-inline="true">Place Order</a>
<br>
<br>
		<div data-role="footer">
    			<h1>JelbsWorks 2016</h1>
  		</div>
		</body>
</html>