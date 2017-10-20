<?php
require_once("./head.staff.php");

	echo "<title>Add Products</title>";
	
		if($_POST){
			//print_r($_POST);
			$p_ID = $_POST['p_ID'];
			$p_Name = $_POST['p_Name'];
			$p_description = $_POST['p_description'];
			$p_price = $_POST['p_price'];
			
			//print_r($_POST);
			//break;			
			try{
				$sql = "INSERT INTO products (p_ID,p_Name,p_description,p_price) VALUES (:p_ID,:p_Name,:p_description,:p_price)";
				
				$q = $DBH->prepare($sql);
						$q->bindValue(':p_ID', $p_ID);
						$q->bindValue(':p_Name', $p_Name);
						$q->bindValue(':p_description', $p_description); 
						$q->bindValue(':p_price', $p_price);
						
				$q->execute();
				echo "Products Added";
				//header("Location: editProd.php");
				echo '<meta http-equiv="refresh" content="2;URL=\'editProd.php\'" />';
			}catch(PDOException $e) {echo 'Error';}
		}
		?>		

			<h1>Add Product</h1>
			<form action="addProd.php" method="POST" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" accept-charset="UTF-8" >
		<div class="ui-field-contain">
		
			<?PHP
				if(isset($errorMsg) && $errorMsg) {
					echo "<p style=\"color: red;\">*",htmlspecialchars($errorMsg),"</p>\n\n";
				}
			?>
		
        		<label for="p_ID">Product ID:</label>
        		<input type="number" name="p_ID" id="p_ID" placeholder="add a product ID" value="<?PHP if(isset($_POST['p_ID'])) echo htmlspecialchars($_POST['p_ID']); ?>">  
				
				<label for="p_Name">Product Name:</label>
        		<input type="text" name="p_Name" id="p_Name" placeholder="add a Product name" value="<?PHP if(isset($_POST['p_Name'])) echo htmlspecialchars($_POST['p_Name']); ?>">  
				
       		 	<label for="p_description">Description:</label>
        		<input type="text" name="p_description" id="p_description" placeholder="add a description" value="<?PHP if(isset($_POST['p_description'])) echo htmlspecialchars($_POST['p_description']); ?>">
				
				<label for="p_price">Price:</label>
        		<input type="text" name="p_price" id="p_price" placeholder="add a price " value="<?PHP if(isset($_POST['p_price'])) echo htmlspecialchars($_POST['p_price']); ?>">
		
				
			<fieldset class="ui-grid-a">
				<div class="ui-block-a"><button type="submit" data-theme="c">Submit</button></div>
				<div class="ui-block-b"><button type="reset" data-theme="c">reset</button></div>	   
			</fieldset>
				
		</form>
		<div data-role="footer">
    			<h1>JelbsWorks 2016</h1>
  		</div>
	</body> 
</html> 