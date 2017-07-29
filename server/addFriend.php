<?php
	session_start();
	$myEmail = $_SESSION['email'];
	$email = $_REQUEST["q"];
	
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$conn->query("INSERT INTO friends(userEmail, friendEmail)VALUES('".$myEmail."', '".$email."')");
	
	mysqli_close($conn);
?>
