<?php require_once("session.php"); ?>
<?php require_once("included_functions.php"); ?>
<?php $mysqli = db_connection();  ?>
<?php new_header("Who is Who","http://turing.cs.olemiss.edu/~jebojorq/CRUD/"); ?>


	
			<h3>Welcome!</h3>
			
				<a href = "readPeople.php">Proceed to CRUD</a>
			

<?php  new_footer("Who's Who"); ?>
