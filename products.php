<?php
require_once("./head.customer.php");
echo "<h1>Products</h1>";


$sql = "select * from products";
$sth = $DBH->prepare($sql);

$sth->execute();

echo '<table>';
while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
	$p_ID = $row['p_ID'];
	$p_name = $row['p_name'];
	$p_price = $row['p_price'];
	echo '<tr>';
	echo '<td>' . $p_ID . '</td>';
	echo '<td>' . $p_name . '</td>';
	echo '<td>' . $p_price . '</td>';
	echo '<td> <a href="viewProducts.php?p_ID='.$p_ID.'">Details</a> </td>';
	echo '</tr>';
}
echo '</table>';
?>
<br>
<br>
		<div data-role="footer">
    			<h1>JelbsWorks 2016</h1>
  		</div>
		</body>
</html>