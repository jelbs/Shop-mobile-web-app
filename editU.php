<?php
require_once("./head.admin.php");
$id = $_GET['id'];
echo "<h1>Edit Users</h1>";
	
    if ($_POST){
		
		$id = $_GET['id'];//assign post variables 
		$first_name = $_POST['first_name'];
		$surname = $_POST['surname'];
		$address = $_POST['address'];
		$phone = $_POST['phone'];
		$email = $_POST['email'];
		$type_user = $_POST['type_user'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$DOB = $_POST['DOB'];
		//print_r ($_POST); test line 
		if ($password != "") {
			$passwordsql = ', password = :password';
		} else {
			$passwordsql = '';
		}
		try {
		$sql = "UPDATE users SET first_name = :first_name, surname = :surname, DOB = :DOB, address = :address, phone = :phone, email = :email, type_user = :type_user, username = :username ${passwordsql} WHERE id= :id";//creating string ${passwordsql}
			$q = $DBH->prepare($sql); // passing statement using string 
			
				$q->bindValue(':first_name', $first_name); //declaring namespace values 
				$q->bindValue(':surname', $surname); 	
				$q->bindValue(':DOB', $DOB); 
				$q->bindValue(':address', $address); 
				$q->bindValue(':phone', $phone);
				$q->bindValue(':email', $email); 
				$q->bindValue(':type_user', $type_user); 
				$q->bindValue(':username', $username);
				$q->bindValue(':id', $id);
				if ($password != "") {
					$q->bindValue(':password', hash('sha512', $password));
				}
				
			//print_r ($q);
			//print_r ($); // test line 
		$q->execute();
		} catch(PDOException $e) {echo $e;}
		echo "You updated user details";
		echo '<meta http-equiv="refresh" content="2;URL=\'editUsers.php\'" />';
		//header("Location: editUsers.php");;
	
	}
		try{

			$q = $DBH->prepare("SELECT * FROM users WHERE id = :id");
			$q->bindValue(':id', $id);
			$q->execute();
			
			$check=$q->fetch(PDO::FETCH_ASSOC);
			
			$first_name = $check['first_name'];
			$surname = $check['surname'];
			$DOB = $check['DOB'];
			$address = $check['address'];
			$phone = $check['phone'];
			$email = $check['email'];
			$type_user = $check['type_user'];
			$username = $check['username'];
			$password = $check['password'];
			
			//print_r ($check);
						
		} catch(PDOException $e) {echo $e;}
	
		
		
		echo '<form action="editU.php?id='.$id.'" method="POST" >';
		//echo 'User ID <input type="number" name="id" id="id" value="' . (isset($_GET['id'])? htmlspecialchars($_GET['id']): '') .'"/>'; // ternary condition sintax "(condition) ? (true return value) : (false return value)"
		echo 'First Name <input type="text" name="first_name" id="first_name" autocomplete="off" value="' . (isset($first_name)? htmlspecialchars($first_name):''). '"/>';
		echo 'Surname <input type="text" name="surname" id="surname" autocomplete="off" value="' . (isset($surname)? htmlspecialchars($surname): '').' "/>';
		echo 'DOB <input type="date" name="DOB" id="DOB" autocomplete="off" value="' . (isset($DOB)? htmlspecialchars($DOB): ''). '"/>';
		echo 'Address <input type="text" name="address" id="address" autocomplete="off" value="' . (isset($address)? htmlspecialchars($address): '').' "/>';
		echo 'Phone <input type="text" name="phone" id="phone" autocomplete="off" value="' . (isset($phone)? htmlspecialchars($phone): '').' "/>';
		echo 'Email <input type="email" name="email" id="email" autocomplete="off" value="' . (isset($email)? htmlspecialchars($email): '').' "/>';
		echo 'type_user <input type="text" name="type_user" id="type_user" autocomplete="off" value="' . (isset($type_user)? htmlspecialchars($type_user): '').' "/>';
		echo 'Username <input type="text" name="username" id="username" autocomplete="off" value="' . (isset($username)? htmlspecialchars($username): '').' "/>';
		echo 'Password <input type="text" name="password" id="password" autocomplete="off" value=""/>';
		
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