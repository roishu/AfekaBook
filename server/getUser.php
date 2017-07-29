<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	session_start();
	$email = $_SESSION['email'];
	$details = array();
	$details['email'] = $email;
	
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$emailQuery = $conn->query("SELECT * FROM `users` WHERE `Email`='".$email."'");
	$row=mysqli_fetch_array($emailQuery);
	
	$details['firstName'] = $row['FirstName'];
	$details['lastName'] = $row['LastName'];
	$details['dob'] = $row['DOB'];
	$details['gender'] = $row['Gender'];
	$details['profilePic'] = $row['ProfilePic'];
	
	echo json_encode($details);
	mysqli_close($conn);
}
?>