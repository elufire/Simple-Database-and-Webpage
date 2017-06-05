<<?php require_once("session.php"); ?>
<?php 
	require_once("included_functions.php");
	new_header("Admin - Add Login", "/CRUD/addLogin.php"); 
	$mysqli = db_connection();
///////////////////////////////////////////////////////////////////////////////////
//  Step 9  -  invoke verify_login
//				Will redirect to index.php if there is not a SESSION admin_id set


/////////////////////////////////////////////////////////////////////////////////// 

	if (($output = message()) !== null) {
		echo $output;
	}

	  
	  
///////////////////////////////////////////////////////////////////////////////////
//  Step 9  -  invoke verify_login
//				Will redirect to index.php if there is not a SESSION admin_id set


/////////////////////////////////////////////////////////////////////////////////// 
	  

	  
///////////////////////////////////////////////////////////////////////////////////////////////
//  Step 4.  Check to see if username and password text boxes are filled in.
//           If they are, then first check to see if the username already exists
//           If the user name does not exist, then add the username and their hashed password
//               to the admins table in your database 

	if (isset($_POST["submit"])) {
 		if (isset($_POST["username"]) && $_POST["username"] !== "" && isset($_POST["password"]) &&
			$_POST["password"] !== "") {
 			//Grab posted values for username and password. Immediately encrypt the password
				//so that it is set up to compare with the encrypted password in the database
			//Use password_encrypt
 			$username = $_POST["username"];
 			$password = password_encrypt($_POST["password"]);

//Check to make sure user does not already exist by querying database. USE LIMIT 1!
			$query = "SELECT * FROM ";
			$query .= "admins WHERE ";
			$query .= "username = '".$username."' ";
			$query .= "LIMIT 1 ";
			$result = $mysqli->query($query);
//User exists so output that the user already exists
			if ($result && $result->num_rows > 0) {
			$_SESSION["message"] = "The username already exists";
			header("Location: addLogin.php");
			exit;
			}
//User does not already exist so insert into admins table. Execute query
			else {
//Create and execute query to insert just the username and password - recall id is an
			$query = "INSERT INTO admins ";
			$query = "(username, hashed_password) ";
			$query.= "VALUES ('".$username."','".$password."') ";

			$result = $mysqli->query($query);

			if ($result) {
			$_SESSION["message"] = "User successfully added";
			header("Location: addLogin.php");
			exit;
			}
			else {
				$_SESSION["message"] = "Could not add user!";
				header("Location: addLogin.php");
				exit;
			}
		}
		}
	}

	    //Grab posted values for username and password.  Immediately encrypt the password
		//so that it is set up to compare with the encrypted password in the database
		//Use password_encrypt

		
		
//************************** TRY OUT PHP's ENCRYPTION  ******************************// 
//  As of php 5.5 the following hash algorithm is provided in the library. 
// PASSWORD_DEFAULT uses Blowfish encryption, cost 10

// $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
//**********************************************************************************// 

////////////////////////////////////////////////////////////////////////////////////////////////
?>
		
		<div class='row'>
		<label for='left-label' class='left inline'>

		<h3>Add an administrator to Pokemon!</h3>

<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--    Step 2. Create textboxes for adding both a username and password -->
	
	<form action="addLogin.php" method="post">
 	<p>Username:<input type="text" name="username" /> </p>
 	<p>Password: <input type="password" name="password" value="" /> </p>
 	<input type="submit" name="submit" value="Submit" />
	</form>
	
	
	
<!--///////////////////////////////////////////////////////////////////////////////////////////////// -->



<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->
<!--    Step 3b. Display current Administrators.  Also provide a link next to each person that allows you to delete -->
<!--            them from your database This requires including their id # in the query string -->

			
			<p><br /><br /><hr />
			<h2>Current Admins</h2>
			<?php
 			// Write & execute query to select from admins
 			$query = "SELECT * FROM ";
 			$query = "admins";
 			$result = $mysqli->query($query);

 			if ($result && $result->num_rows > 0) {
 			echo "<table>";
 			while($row = $result->fetch_assoc()) {
				echo "<tr>";
				echo "<td>".$row["username"]."</td>";?>
				<td>&nbsp;&nbsp;&nbsp;&nbsp;<a href="deleteLogin.php?id=<?php echo
				$row["id"]?>">Delete</a></td>
				<?php echo "</tr>";
 			}
			echo "</table><hr /><br /><br />";
			 }
 ?>
 </p>

			
			
			
			
			
			</p>
<!--//////////////////////////////////////////////////////////////////////////////////////////////// -->
			
  	  <?php echo "<br /><p>&laquo:<a href='readPokemon.php'>Back to Main Page</a>"; ?>
			
	</div>
	</label>

<?php  new_footer("Who's Who"); ?>