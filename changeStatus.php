<?php
	require_once("./head.delivery.php");
	$ID = $_GET['ID'];

	echo "<h1>Edit Status</h1>";
	
    if ($_POST){
		
		$ID = $_POST['ID'];
		$status = $_POST['status'];//assign post variables 

		//print_r ($_POST); test line 
		try {
			
			$sql = "UPDATE orders SET status = :status WHERE ID = :ID";//creating string 
			$q = $DBH->prepare($sql); // passing statement using string 
			
			$q->bindValue(':ID', $ID); //declaring namespace values 
			$q->bindValue(':status', $status); 	
			$q->execute();
			
			echo "You updated Order Status";
			
			echo '<meta http-equiv="refresh" content="2;URL=\'orderStatus.php\'" />';
			//print_r ($q);
			
		} catch(PDOException $e) {echo $e;}
	
	}
		
							try{
						
						$q = $DBH->prepare("SELECT status FROM orders WHERE ID = :oID");
						$q->bindValue(':oID', $ID);
						$q->execute();
						
						$check=$q->fetch(PDO::FETCH_ASSOC);
						
						$status = $check['status'];
						
								
						//echo 'current name' . $p_name;
	
						
		} catch(PDOException $e) {echo $e;}
	
		
		
		echo '<form action="changeStatus.php?ID='.$ID.'" method="POST" >';
		echo 'Order ID <input type="number" name="ID" id="ID" value="' . (isset($_GET['ID'])? htmlspecialchars($_GET['ID']): '') .'"/>'; // ternary condition sintax "(condition) ? (true return value) : (false return value)"
		echo 'Order Status <input type="text" name="status" id="status" value="' . (isset($status)? htmlspecialchars($status):''). '"/>';
		
		echo '<fieldset class="ui-grid-a">';
				echo'<div class="ui-block-a"><button type="submit" data-theme="c">Submit</button></div>';
				echo'<div class="ui-block-b"><button type="reset" data-theme="c">reset</button></div>';	   
		echo '</fieldset>';		
		echo '</form>';
	 
 
?>
	<br>
		<div data-role="footer">
    			<h1>JelbsWorks 2016</h1>
  		</div>
</body> 
</html>