<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	session_start();
	$data = json_decode(file_get_contents("php://input"));
	 
	$lemail = $data->lemail;
	$lpwd = $data->lpwd;
	
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$arr = array(); 
	
	$emailChack = $conn->query("SELECT * FROM `users` WHERE `Email`='".$lemail."'"); 
	$row=mysqli_fetch_array($emailChack);
	if($row['Password']==hash('sha256',$lpwd)){
		$_SESSION['email'] = $row['Email'];
		echo '1'; //user found';
	}
	 else 
	 	echo '0'; //user not found';
	 mysqli_close($conn);
} 

?>