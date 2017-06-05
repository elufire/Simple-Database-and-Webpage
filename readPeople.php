<?php 
	require_once("session.php"); 
	require_once("included_functions.php");
	new_header("Here is Who's Who!"); 
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

	
	//****************  Add Query
	//  Query people to select PersonID, FirstName, and LastName, sorting in ascending order by LastName
	$query = "SELECT PersonID, FirstName, LastName ";
	$query .= "FROM people ";
	$query .= "ORDER BY LastName ASC";



	//  Execute query

	$result = $mysqli->query($query);		
				

	if ($result && $result->num_rows > 0) {
		echo "<div class='row'>";
		echo "<center>";
		echo "<h2>Here is Who's Who</h2>";
		echo "<table>";
		echo "<tr><th>Name</th><th></th><th></th></tr>";
		while ($row = $result->fetch_assoc())  {
			echo "<tr>";
			//Output FirstName and LastName
			echo "<td>".$row['FirstName']." ".$row['LastName']."</td> ";
	

?>


			<td>&nbsp;<a href="editPeople.php">Edit</a>&nbsp;&nbsp;</td>
			<td>&nbsp;<a href="deletePeople.php" onclick="return
			confirm('Are you sure?');">Delete</a></td>

			
			<?php echo "</tr>";
		}
		echo "</table>";
		echo "<br /><br /><a href='addPeople.php'>Add a person</a>";
		echo "</center>";
		echo "</div>";
	}

?>

<?php  new_footer("Who's Who"); ?>