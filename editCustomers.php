<?php
	require_once("./head.customer.php");
	echo "<h1>Edit details</h1>";

	echo "<br>"; 
	
		if($_POST){
			$id = $_SESSION['id'];//assign post variables 
			$first_name = $_POST['first_name'];
			$surname = $_POST['surname'];
			$DOB = $_POST['DOB'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			
			//echo "First name: ".$first_name." Surname: ".$surname." DOB ".$DOB."Address: ".$address." phone: ".$phone."<br>";
		
			$sql = "UPDATE users SET first_name = :first_name, surname = :surname, DOB = :DOB, address = :address, phone = :phone, email = :email WHERE id = :id";
			$q = $DBH->prepare($sql); // passing statement using string 
		
			$q->bindValue(':first_name', $first_name); //declaring namespace values 
			$q->bindValue(':surname', $surname); 	
			$q->bindValue(':DOB', $DOB); 
			$q->bindValue(':address', $address); 
			$q->bindValue(':phone', $phone);
			$q->bindValue(':email', $email);
			$q->bindValue(':id', $_SESSION['id']);
			$q->execute();
		
				//$q->execute();
			echo "You updated your details";
			echo '<meta http-equiv="refresh" content="2;URL=\'customer.php\'" />';
		}else{
			$q = $DBH->prepare("SELECT * FROM users WHERE id = :id");
			$q->bindValue(':id', $_SESSION['id']);
			$q->execute();
			$check=$q->fetch(PDO::FETCH_ASSOC);
			//print_r($check);
			
			$first_name = $check['first_name'];
			$surname = $check['surname'];
			$DOB = $check['DOB'];
			$address = $check['address'];
			$phone = $check['phone'];
			$email = $check['email'];
			//echo 'current name' . $p_name;
		
		
			
			//echo $first_name;
			//die();
			echo '<form action="editCustomers.php" method="POST" >';
			echo 'First Name <input type="text" name="first_name" id="first_name" value="' . (isset($first_name)? htmlspecialchars($first_name):''). '"/>';  // ternary condition sintax "(condition) ? (true return value) : (false return value)"
			echo 'Surname <input type="text" name="surname" id="surname" value="' . (isset($surname)? htmlspecialchars($surname): '').' "/>';
			echo 'Date of Birth <input type="date" name="DOB" id="DOB" value="' . (isset($DOB)? htmlspecialchars($DOB): ''). '"/>';
			echo 'Address <input type="text" name="address" id="address" value="' . (isset($address)? htmlspecialchars($address): '').' "/>';
			echo 'Phone Number <input type="number" name="phone" id="phone" value="' . (isset($phone)? htmlspecialchars($phone): ''). '"/>';
			echo 'Email <input type="email" name="email" id="email" value="' . (isset($email)? htmlspecialchars($email): '').' "/>';
			
			echo '<fieldset class="ui-grid-a">';
					echo'<div class="ui-block-a"><button type="submit" data-theme="c">Submit</button></div>';
					echo'<div class="ui-block-b"><button type="reset" data-theme="c">reset</button></div>';	   
			echo '</fieldset>';		
			echo '</form>';
		 
		}
?>
<br>
		<div data-role="footer">
    			<h1>JelbsWorks 2016</h1>
  		</div>
</body> 
</html>