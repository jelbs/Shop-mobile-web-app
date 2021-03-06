

<?php
require_once("./head.delivery.php");

echo "<h1>Orders</h1>";

function getItemInfo($p_ID, $DBH){ 

	$q = $DBH->prepare("SELECT * FROM products WHERE p_ID= :p_ID"); 
	$q->bindValue(':p_ID', $p_ID); 
	$q->execute();
	
	return ($q->fetch(PDO::FETCH_ASSOC) );
}
	$it = $DBH->prepare("SELECT * FROM orders "); 
	$it->execute();
	//$it->fetch(PDO::FETCH_ASSOC);
	echo "<table>";
	foreach ($it->fetchAll(PDO::FETCH_ASSOC) as $order){	
		$o = $DBH->prepare("SELECT id, first_name, surname, address,phone, email FROM users WHERE id = :uid ");
		$o->bindValue(':uid', $order['userid']);
		$o->execute();
		$userDetails=$o->fetchAll(PDO::FETCH_ASSOC)[0];
		echo "<tr><td> Order ID: ${order['ID']}</td><td>Date: ${order['time_date']}</td><td>Status: ${order['status']}</td></tr>";
		
		echo "<tr><td colspan=\"3\">";
		echo "First name: ${userDetails['first_name']}<br/>";
		echo "Last name: ${userDetails['surname']}<br/>";
		echo "Address: ${userDetails['address']}<br/>";
		echo "phone: ${userDetails['phone']}<br/>";
		echo "email: ${userDetails['email']}<br/>";
		
		echo "<hr/>";
		$items = trim($order['orderdetails']); //remove whitespaces from begining (and end) 
		if ($items != "") {
			$totalPrice=0;
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
				$totalPrice += $row['p_price'];
				
			}
			echo "<tr><td colspan=\"3\">";
			echo '<td>Total=' .$totalPrice. '</td>';
			echo '<td> <a href="printPDF.php?ID='.$order['ID'].'" data-role="button" data-inline="true">Print</a> </td>';
			echo '</table></td></tr><tr><td colspan="3"><hr/><br><br></td></tr>'; 
			

		}	
	}
	echo "</table>";
?>
<br>
		<div data-role="footer">
    			<h1>JelbsWorks 2016</h1>
  		</div>
		</body>
</html>