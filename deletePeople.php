<?php require_once("session.php"); ?>
<?php 
	require_once("included_functions.php");
	new_header("Here is Who's who!", "/CRUD/DELETE/deletePeople.php"); 
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}

  	if (isset($_GET["id"]) && $_GET["id"] !== "") {
 		$ID = $_GET["id"];
//////////////////////////////////////////////////////////////////////////////////////				
				// Create a query to delete this id from persons
			$query = "DELETE people ";
			$query .= "Where PersonID = {$ID} ";

				
				// Execute query
			$result = $mysqli->query($query);
//////////////////////////////////////////////////////////////////////////////////////		
		if ($result && $mysqli->affected_rows === 1) {
			$_SESSION["message"] = "Person successfully deleted!";
			$output = message();
			echo $output;
			echo "<br /><br /><p>&laquo:<a href='readPeople.php'>Back to Main Page</a>";

		}
		else {
		$_SESSION["message"] = "Person could not be deleted!";
		header("Location: readPeople.php");
		exit;
		}
	}
	else {
		$_SESSION["message"] = "Person could not be found!";
		header("Location: readPeople.php");
		exit;
	}

			
			
?>		
						
<?php  new_footer("Who's Who"); ?>