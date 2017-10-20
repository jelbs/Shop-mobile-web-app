<?php
require_once("./head.admin.php");
echo "<h1>Edit Users</h1>";

		function getPassword($pass){
		return substr($pass, 0, 5);
		}
		
        $sql = "SELECT * FROM users";
        $sth = $DBH->prepare($sql);
		//for each 
		
		$result = $DBH->query($sql);
		//$p_ID = $row['p_ID'];
		//print_r ($result);
			
		echo '<table data-role="table" class="ui-responsive">'; 	
		   echo '<thead>';
			echo '<tr>';
				echo '<td> ID </td>'; 
				echo '<td> First Name </td>'; 
				echo '<td> Surname </td>'; 
				echo '<td> DOB </td>'; 
				echo '<td> Address </td>';
				echo '<td> Phone </td>'; 
				echo '<td> Email </td>';
				echo '<td> User Type </td>'; 
				echo '<td> Username </td>'; 
				echo '<td> Password </td>'; 
				echo '<td> Edit </td>';
			echo '</tr>';
		  echo '</thead>';
			foreach ($result as $row){
			//print_r ($row);
			  echo '<tbody>';
				echo '<tr>';
					 echo '<td >' . $row['id'] . '</td>';
					 echo '<td>' . $row['first_name'] . '</td>';
					 echo '<td>' . $row['surname'] . '</td>';
					 echo '<td>' . $row['DOB'] . '</td>';
					 echo '<td>' . $row['address'] . '</td>';
					 echo '<td>' . $row['phone'] . '</td>';
					 echo '<td>' . $row['email'] . '</td>';
					 echo '<td>' . $row['type_user'] . '</td>';
					 echo '<td>' . $row['username'] . '</td>';
					 echo '<td>'.getPassword($row['password']).'</td>';
					 echo '<td> <a href="editU.php?id='.$row['id'].'"> Edit Row</a> </td>';
					 
				echo '</tr>';
              echo '</tbody>';
			}	
		echo '</table>'; 
        $sth->execute();

	
	?> 
		<br>
		<div data-role="footer">
    			<h1>JelbsWorks 2016</h1>
  		</div>
	</body>
</html> 