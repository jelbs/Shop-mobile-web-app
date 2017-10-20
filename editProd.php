<?php
require_once("./head.staff.php");

 echo "<h1>Add/Edit Products</h1>";
 try {
 		
        $sql = "SELECT * FROM products";
        $sth = $DBH->prepare($sql);
		//for each 
		
		$result = $DBH->query($sql);
		//$p_ID = $row['p_ID'];
		//print_r ($result);
			
		echo '<table>'; 	
			echo '<tr>';
				echo '<td> ID </td>'; 
				echo '<td> Name </td>'; 
				echo '<td> Description </td>'; 
				echo '<td> Price </td>'; 
				echo '<td> Action </td>';
			echo '</tr>';
			foreach ($result as $row){
			//print_r ($row);
				echo '<tr>';
					 echo '<td>' . $row['p_ID'] . '</td>';
					 echo '<td>' . $row['p_name'] . '</td>';
					 echo '<td>' . $row['p_description'] . '</td>';
					 echo '<td>€' . $row['p_price'] . '</td>';
					 echo '<td> <a href="edit.php?p_ID='.$row['p_ID'].'"> Edit Row</a> </td>';
					 
					 
				echo '</tr>';

			}	
		echo '</table>'; 
        $sth->execute();
	 } catch(PDOException $e) {echo $e;}
	
 ?> 
		<a href="addProd.php" data-role="button" data-inline="true">Add New Product</a>
		<br>
		<div data-role="footer">
    			<h1>JelbsWorks 2016</h1>
  		</div>
	</body>
</html> 