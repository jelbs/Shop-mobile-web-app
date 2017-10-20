<?php
session_start();
//echo 'I am here'; ----> test line 
include('db.php');
include("simple-php-captcha.php"); //importing captcha 
$captchasession =  $_SESSION['captcha']['code']; 
$_SESSION['captcha'] = simple_php_captcha();
$_SESSION['cart'] = '';
//$type_user = $_POST['type_user'];
?>
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
		<title>Login</title>
	</head>
	<body>
		<?php	
			if($_POST) {
				$username = $_POST['username'];
				$password = $_POST['password'];

				$message = '';
				$username = htmlspecialchars($_POST['username']); // sanitize post data from dangerous caracters 
				$password = htmlspecialchars($_POST['password']);
				$captcha = htmlspecialchars($_POST['captcha']);
				//$type_user = htmlspecialchars($_POST['type_user']);
				if (empty($username) || empty($password)) {
					$message .= "Missing Username or password";
				} elseif (strtolower($captchasession) != strtolower($captcha))  { // strtolower disables case sensitive 
					$message .= "Captcha failed";
				} else {
					try{
						$host = '127.0.0.1';
						$dbname='shop';
						$user='root';
						$pass='';
						$DBH = new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
						echo $username; 
						echo $password;
						echo $captcha;
						echo $dbname;
						//echo $type_use;	
						$q = $DBH->prepare("SELECT * FROM users WHERE username = :username and password = :password LIMIT 1");
						$q->bindValue(':username', $username);
						$q->bindValue(':password', hash('sha512', $password)); // hashing clear txt password on a fly with sha512 (most common hash for passwords in ind standard)
						//$q->bindValue(':password', $password); 
						$q->execute();
						$check=$q->fetch(PDO::FETCH_ASSOC);
						
						//echo 'I am here now'; -----> TEST LINE 
						//echo $q; --------> TEST LINE 
						//print_r ($check); ----------> TEST LINE print contents in $check
						//break; ---------------------> TEST LINE this stops the code here and runs whatever piece of code above it 
						$message = "";
						
						if(!empty($check))
						{
								//$username = $check['username'];
								//$password = $check['password'];  two lines to check my variables 
								$type_user = $check['type_user'];
								//$message='Logging in';
								$_SESSION['username'] = $check['username'];
								$_SESSION['id'] = $check['id'];
								$_SESSION['sid'] = session_id();
								//print_r($check);
								$q = $DBH-> prepare("UPDATE users set sessionid = :sid where id = :id");
								$q->bindValue(':sid', $_SESSION['sid']);
								$q->bindValue(':id', $_SESSION['id']);
								$q->execute();
								//die();

									if($type_user == '1')
									{ 
										header("Location: admin.php");
										//echo '<script>window.location="admin.php" </script>';
									}
									else if($type_user == '2')
									{
										header("Location: staff.php");
										//echo '<script>window.location="staff.php" </script>';
									}
									else if($type_user == '3')
									{
										header("Location: delivery.php");
										//echo '<script>window.location="delivery.php" </script>';
									}
									else if($type_user == '4')
									{
										header("Location: customer.php");
										//echo '<script>window.location="customer.php" </script>';
									}
						}else {
							$message="Sorry your details are incorrect.";
							
						}
					}catch(PDOException $e){echo "error: ${e}";}
					
				}
			}
		?>
		<div data-role="page" >
		  <div data-role="header">
   		       <h1>Building Supplies</h1>
  		  </div>
		<div data-role="navbar">
			<ul>

  				<li><a href="main.php" class="ui-btn ui-icon-home ui-btn-icon-left">Home</a></li>
 				
			</ul>
		</div>
		
		<h2>Login</h2><br>
		
		<form action="login.php" method="POST">
			Username <input type="text" name="username" /><br>
			Password <input type="password" name="password" /><br>
			<img src="<?= $_SESSION['captcha']['image_src'] ?>" ><br> 
			Security token <input type="text" name="captcha" />
			<fieldset class="ui-grid-a">
				<div class="ui-block-a"><button type="submit" data-theme="c">Submit</button></div>
				<div class="ui-block-b"><button type="reset" data-theme="c">reset</button></div>	   
			</fieldset>
				
		<?php 
			if(!empty($message)){
				echo "<br>$message";
			}
		?>
		</form>
		
		<br>
		
		<div data-role="footer">
    			<h1>JelbsWorks 2016</h1>
  		</div>
		
	</body>
</html>
			