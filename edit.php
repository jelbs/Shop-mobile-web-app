<?php
	require_once("./head.staff.php");
	$p_ID = $_GET['p_ID'];

	echo "<h1>Edit Products</h1>";
	
    if ($_POST){
		
		$p_ID = $_POST['p_ID'];//assign post variables 
		$p_name = $_POST['p_name'];
		$p_description = $_POST['p_description'];
		$p_price = $_POST['p_price'];
		//print_r ($_POST); test line 
		try {
			
			$sql = "UPDATE products SET p_ID =:p_ID, p_name= :p_name, p_description = :p_description, p_price= :p_price WHERE p_ID= :p_ID";//creating string 
			$q = $DBH->prepare($sql); // passing statement using string 
			
			$q->bindValue(':p_ID', $p_ID); //declaring namespace values 
			$q->bindValue(':p_name', $p_name); 	
			$q->bindValue(':p_description', $p_description); 
			$q->bindValue(':p_price', $p_price); 
			$q->execute();
			echo "You updated your details";
			//header("Location: editProd.php");;
			echo '<meta http-equiv="refresh" content="2;URL=\'editProd.php\'" />';
			//print_r ($q);
			
		} catch(PDOException $e) {echo $e;}
	
	}
		
							try{
						
						$q = $DBH->prepare("SELECT * FROM products WHERE p_ID = :pid");
						$q->bindValue(':pid', $p_ID);
						$q->execute();
						
						$check=$q->fetch(PDO::FETCH_ASSOC);
						
						$p_name = $check['p_name'];
						$p_description = $check['p_description'];
						$p_price = $check['p_price'];
								
						//echo 'current name' . $p_name;
	
						
		} catch(PDOException $e) {echo $e;}
	
		
		
		echo '<form action="edit.php?p_ID='.$p_ID.'" method="POST" >';
		echo 'Product ID <input type="number" name="p_ID" id="p_ID" value="' . (isset($_GET['p_ID'])? htmlspecialchars($_GET['p_ID']): '') .'"/>'; // ternary condition sintax "(condition) ? (true return value) : (false return value)"
		echo 'Product Name <input type="text" name="p_name" id="p_name" value="' . (isset($p_name)? htmlspecialchars($p_name):''). '"/>';
		echo 'Product Description <input type="text" name="p_description" id="p_description" value="' . (isset($p_description)? htmlspecialchars($p_description): '').' "/>';
		echo 'Product Price <input type="text" name="p_price" id="p_price" value="' . (isset($p_price)? htmlspecialchars($p_price): ''). '"/>';
		
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