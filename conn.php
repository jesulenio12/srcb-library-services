<?php
	$conn=mysqli_connect("localhost", "root", "", "lib-system");
	
	if(!$conn){
		die("Error: Failed to connect to database!");
	}
?>