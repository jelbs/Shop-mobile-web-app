<?php
require_once('./db.php');
session_start();
$headError='';
// test if session match user in DB
if ($_SESSION['sid'] == "") {
	$headError='missing session in authorized area';
}
$q = $DBH->prepare("SELECT * FROM users WHERE sessionid = :sid LIMIT 1");
$q->bindValue(':sid', $_SESSION['sid']);
$q->execute();
$scheck=$q->fetch(PDO::FETCH_ASSOC);
if (empty($scheck) || ( $scheck['username'] != $_SESSION['username'])) {
	$headError='session mismatch';
}

?>
<html>
	<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />
	</head>
	<body>
<div data-role="page">
		  <div data-role="header">
   		       <h1>Building Supplies</h1>
  		  </div>
		<div data-role="navbar">
			<ul>
  				<li><a href="delivery.php" class="ui-btn ui-icon-home ui-shadow ui-corner-all ui-btn-icon-left">Home</a></li>
 				<li><a href="logout.php" class="ui-btn ui-icon-delete ui-shadow ui-corner-all ui-btn-icon-left">Logout</a></li>
			</ul>
		</div>
<?php
if ($headError != '') {
	echo "$error</body></html>";
	die();
}
?>			
