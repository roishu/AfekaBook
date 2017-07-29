<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	session_start();
	$data = json_decode(file_get_contents("php://input"));
	$fname = $data->fname;
	$lname = $data->lname;
	$dob = $data->dob; 
	$email = $data->email;
	$pwd = $data->pwd;
	$hashed_password = hash('sha256',$pwd);
	$gender = $data->gender;
	$dob = date_create()->format('Y-m-d');
	
	$arr = array();
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	
	$emailChack = $conn->query("SELECT * FROM `users` WHERE `Email`='".$email."'");
	if (mysqli_num_rows($emailChack)==0){
		$conn->query("INSERT INTO users(FirstName, LastName, DOB, Email, Password, Gender)VALUES('".$fname."', '".$lname."', '".$dob."', '".$email."', '".$hashed_password."', '".$gender."')");
		$_SESSION['email']=$email;
		echo '1';//'Registretion Completed';
	}
	else{
		echo '0'; //Email alredy in use! please try another one';
	}
	mysqli_close($conn);
}

?>

