<?php
	include ("db.php");
	require_once(dirname(__FILE__).'/html2pdf/vendor/autoload.php');
    $html2pdf = new HTML2PDF('P','A4','en');
    $payload = '<html><head></head><body>';
	$ID = $_GET['ID'];
	
	function getItemInfo($p_ID, $DBH){ 
		$q = $DBH->prepare("SELECT * FROM products WHERE p_ID= :p_ID"); 
		$q->bindValue(':p_ID', $p_ID); 
		$q->execute();
		
		return ($q->fetch(PDO::FETCH_ASSOC) );
	}
	$it = $DBH->prepare("SELECT * FROM orders WHERE id = ${ID}"); 
	$it->execute();

	$order = $it->fetchAll(PDO::FETCH_ASSOC)[0];
	$o = $DBH->prepare("SELECT id, first_name, surname, address,phone, email FROM users WHERE id = :uid ");
	$o->bindValue(':uid', $order['userid']);
	$o->execute();
	$userDetails=$o->fetchAll(PDO::FETCH_ASSOC)[0];
	$payload .= "<table>";
	$payload .= "<tr><td> Order ID: ${order['ID']}</td><td>Date: ${order['time_date']}</td><td>Status: ${order['status']}</td></tr>";
	
	$payload .= "<tr><td colspan=\"3\">";
	$payload .= "First name: ${userDetails['first_name']}<br/>";
	$payload .= "Last name: ${userDetails['surname']}<br/>";
	$payload .= "Address: ${userDetails['address']}<br/>";
	$payload .= "phone: ${userDetails['phone']}<br/>";
	$payload .= "email: ${userDetails['email']}<br/>";
	
	$payload .= "<hr/>";
	$items = trim($order['orderdetails']); //remove whitespaces from begining (and end) 
	if ($items != "") {
		$totalPrice=0;
		$tok = explode(" ", $items);
		$payload .= '<table>'; 
		$payload .= '<tr>';
		$payload .= '<td> ID </td>'; 
		$payload .= '<td> Name </td>'; 
		$payload .= '<td> Description </td>'; 
		$payload .= '<td> Price </td>';
		$payload .= '</tr>';
		foreach($tok as $item) { 
			$row = getItemInfo($item, $DBH);
			$payload .= '<tr>';
			$payload .= '<td>' . $row['p_ID'] . '</td>';
			$payload .= '<td>' . $row['p_name'] . '</td>';
			$payload .= '<td>' . $row['p_description'] . '</td>';
			$payload .= '<td>€' . $row['p_price'] . '</td>';
			$payload .= '</tr>';
			$totalPrice += $row['p_price'];
			
		}
		$payload .= "<tr><td colspan=\"3\"></td>";
		$payload .= '<td>Total=' .$totalPrice. '</td></tr>';
		$payload .= '</table></td></tr><tr><td colspan="3"><hr/><br/><br/></td></tr>'; 
		

	}
	$payload .= "</table></body></html>";
	$html2pdf->WriteHTML($payload);
	$html2pdf->Output('slip.pdf');
	//echo $payload;
?>
