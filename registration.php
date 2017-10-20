<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />

		<title>Register Please</title>
	</head>
	<body>
<div data-role="page" >
		  <div data-role="header">
   		       <h1>Building Supplies</h1>
  		  </div>
		<div data-role="navbar">
			<ul>
  				<li><a href="main.php" class="ui-btn ui-icon-home ui-btn-icon-left">Home</a></li>
			</ul>
		</div>
		<?php
		if($_POST){
			//print_r($_POST);
			$first_name = $_POST['first_name'];
			$surname = $_POST['surname'];
			$DOB = $_POST['DOB'];
			$address = $_POST['address'];
			$phone = $_POST['phone'];
			$email = $_POST['email'];
			//print_r($_POST);
			//break;
			$type_user = 4;
			$username = $_POST['username'];
			$password = $_POST['password'];		
			
			//echo "Username ".$username." Password: ".$password."<br>";
						
			try{
				$host = '127.0.0.1';
				$dbname = 'shop';
				$user = 'root';
				$pass = '';
				$DBH = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
				
				$sql = 'SELECT * FROM USERS where username = "'.$username.'"';
				$q = $DBH->prepare($sql);
				$q->execute();
				$res = $q->fetchAll(PDO::FETCH_ASSOC);
				if(count($res)>0){
				  echo 'username taken';
				} else {
				  
				
				$sql = "INSERT INTO users (first_name,surname,DOB,address,phone,email,type_user,username, password) VALUES (:first_name,:surname,:DOB,:address,:phone,:email,:number,:username,:password)";
				
				$q = $DBH->prepare($sql);
						$q->bindValue(':first_name', $first_name);
						$q->bindValue(':surname', $surname);
						$q->bindValue(':DOB', $DOB); 
						$q->bindValue(':address', $address);
						$q->bindValue(':phone', $phone);
						$q->bindValue(':email', $email);
						$q->bindValue(':number', $type_user);
						$q->bindValue(':username', $username);
						$q->bindValue(':password', hash('sha512', $password)); // hashing clear txt password on a fly with sha512 (most common hash for passwords in ind standard)
				
				$q->execute();
				echo "You are now registered";
				//header("Location: login.php");
				echo '<meta http-equiv="refresh" content="2;URL=\'login.php\'" />';
				}
			}catch(PDOException $e) {echo 'Error';}
			
		}
		?>		

			<h1>Register Here</h1>
			<form action="registration.php" method="POST" action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" accept-charset="UTF-8" >
		<div class="ui-field-contain">
		
			<?PHP
				if(isset($errorMsg) && $errorMsg) {
					echo "<p style=\"color: red;\">*",htmlspecialchars($errorMsg),"</p>\n\n";
				}
			?>
		
        		<label for="first_name">First Name:</label>
        		<input type="text" name="first_name" id="first_name" placeholder="Your first name" value="<?PHP if(isset($_POST['first_name'])) echo htmlspecialchars($_POST['first_name']); ?>">  
				
				<label for="surname">Surname:</label>
        		<input type="text" name="surname" id="surname" placeholder="Your surname" value="<?PHP if(isset($_POST['surname'])) echo htmlspecialchars($_POST['surname']); ?>">  
				
       		 	<label for="DOB">Date of Birth:</label>
        		<input type="date" name="DOB" id="DOB" value="<?PHP if(isset($_POST['DOB'])) echo htmlspecialchars($_POST['DOB']); ?>">
				
				<label for="Address">Address:</label>
        		<input type="text" name="address" id="address" placeholder="Your address" value="<?PHP if(isset($_POST['address'])) echo htmlspecialchars($_POST['address']); ?>">
				
				<label for="phone">Phone Number:</label>
        		<input type="text" name="phone" id="phone" placeholder="Your phone" value="<?PHP if(isset($_POST['phone'])) echo htmlspecialchars($_POST['phone']); ?>">
				
        		<label for="email">E-mail:</label>
        		<input type="email" name="email" id="email" placeholder="Your email" value="<?PHP if(isset($_POST['email'])) echo htmlspecialchars($_POST['email']); ?>">
				
				<label for="username">Username:</label> 
				<input type="text" name="username" id="username" value="<?PHP if(isset($_POST['username'])) echo htmlspecialchars($_POST['username']); ?>">
				
				<label for="password">Password:</label> 
				<input type="password" name="password" id="password" value="<?PHP if(isset($_POST['password'])) echo htmlspecialchars($_POST['password']); ?>">
				</div>
				
			<fieldset class="ui-grid-a">
				<div class="ui-block-a"><button type="submit" data-theme="c">Submit</button></div>
				<div class="ui-block-b"><button type="reset" data-theme="c">reset</button></div>	   
			</fieldset>
				
		</form>
		<br>
		<div data-role="footer">
    			<h1>JelbsWorks 2016</h1>
  		</div>
	</body>
</html>