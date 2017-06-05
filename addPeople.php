<?php require_once("session.php"); ?>
<?php 
	require_once("included_functions.php");
	new_header("Here is Who's who!", "/CRUD/READ/editPeople.php"); 
	$mysqli = db_connection();
	if (($output = message()) !== null) {
		echo $output;
	}
	
	echo "<h3>Add to Who''s who!</h3>";
	echo "<div class='row'>";
	echo "<label for='left-label' class='left inline'>";

	if (isset($_POST["submit"])) {
		if( (isset($_POST["FirstName"]) && $_POST["FirstName"] !== "") && (isset($_POST["LastName"]) && $_POST["LastName"] !== "") &&(isset($_POST["Birthdate"]) && $_POST["Birthdate"] !== "") &&(isset($_POST["BirthCity"]) && $_POST["BirthCity"] !== "") &&(isset($_POST["BirthState"]) && $_POST["BirthState"] !== "") &&(isset($_POST["Region"]) && $_POST["Region"] !== "") ) {


//////////////////////////////////////////////////////////////////////////////////////////////////
			//STEP 3.
				//Create query to insert information that has been posted

			$ID = $_POST["id"];
		$FN = $_POST["FirstName"];
		$LN = $_POST["LastName"];
		$BD = $_POST["Birthdate"];
		$BC = $_POST["BirthCity"];
		$BS = $_POST["BirthState"];
		$RG = $_POST["Region"];
			
		// UPDATE query on $ID
	$query = "INSERT INTO people (FirstName, LastName, Birthdate, BirthCity, BirthState, Region) ";
	$query .= "VALUES ($FN, $LN, $BD, $BC, $BS, $RG) ";



					
					// Execute query
	$result = $mysqli->query($query);
//////////////////////////////////////////////////////////////////////////////////////////////////


			if($result) {

			$_SESSION["message"] = $_POST["FirstName"]." ".$_POST["LastName"]." has been added";
				header("Location: readPeople.php");
				exit;

			}
			else {

			$_SESSION["message"] = "Error! Could not change ".$_POST["FirstName"]." ".$_POST["LastName"];
			}
		}
		else {
			$_SESSION["message"] = "Unable to add person. Fill in all information!";
			header("Location: addPeople.php");
			exit;
		}
	}
	else {

			$row = $result->fetch_assoc();
			echo "<div class='row'>";
			echo "<label for='left-label' class='left inline'>";

//////////////////////////////////////////////////////////////////////////////////////////////////
					// STEP 1.  Create a form that will post to this page: addPeople.php
					//          Also include a submit button
					// STEP 2.  Include <input> tags for each of the attributes in person:
					//                  First Name, Last Name, Birthdate, Birth City, Birth State, Region

			echo "<p><form action = 'addPeople.php?id={$ID}' method='post'>";
			echo "<p><input type = 'text' name = 'FirstName' value = '".$row["FirstName"]."' /></p>";
			echo "<p><input type = 'text' name = 'LastName' value = '".$row["LastName"]."' /></p>";	
			echo "<p><input type = 'text' name = 'Birthdate' value = '".$row["Birthdate"]."' /></p>";	
			echo "<p><input type = 'text' name = 'BirthCity' value = '".$row["BirthCity"]."' /></p>";		
			echo "<p><input type = 'text' name = 'BirthState' value = '".$row["BirthState"]."' /></p>";
			echo "<p><input type = 'text' name = 'Region' value = '".$row["Region"]."' /></p>";
			echo "<input type= 'submit' class='button tiny round' value = 'Submit'>";	
			echo "</form></p>";
					
//////////////////////////////////////////////////////////////////////////////////////////////////
					echo "</label>";
					echo "</div>";

					echo "<br /><p>&laquo:<a href='readPeople.php'>Back to Main Page</a>";
				
	  }
?>


<?php include("footer.php"); ?>