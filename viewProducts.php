<?php
$p_ID = $_GET['p_ID'];
require_once("./head.customer.php");
echo "<h1>Products</h1>";
			
			$q = $DBH->prepare("SELECT * FROM products WHERE p_ID= :p_ID"); 
			$q->bindValue(':p_ID', $p_ID); 
			$q->execute();
			$row = $q->fetch(PDO::FETCH_ASSOC); 
			
			echo '<table>'; 
					//print_r($row);		error catching line 
					echo '<tr>';
						echo '<td> ID </td>'; 
						echo '<td> Name </td>'; 
						echo '<td> Description </td>'; 
						echo '<td> Price </td>'; 
					echo '</tr>';
					echo '<tr>';
						 echo '<td>' . $row['p_ID'] . '</td>';
						 echo '<td>' . $row['p_name'] . '</td>';
						 echo '<td>' . $row['p_description'] . '</td>';
						 echo '<td>€' . $row['p_price'] . '</td>';
					echo '</tr>';
			echo '</table>'; 
			
							echo "<br><form class='navbar-form navbar-center' action='addtocart.php?p_ID=${p_ID}'>
							<button type='submit' class='btn btn-default'>Add to cart</button>
							</form>";

			?>
		</div>
	</body> 
</html> 
