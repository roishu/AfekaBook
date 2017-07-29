<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	//session_start();
	//$email=$_SESSION['email'];
	
	// date and time
	$date = date('Y-m-d H:i:s');
	$currentDate = strtotime($date);
	$futureDate = $currentDate-(60*5) + (60*60*3);
	$formatDate = date("Y-m-d H:i:s", $futureDate);
	// date and time
	
	
	$data = json_decode(file_get_contents("php://input"));
	$email = $data->email;
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");

	$getLatestPostIdQ = "SELECT MAX(Id) as Id, ThePost,Publisher, Date FROM `posts` WHERE `Date` > '".$formatDate."' and ThePost like '%messi%' and Publisher not like '".$email."'";
	$getLatestPostId=$conn->query($getLatestPostIdQ);
	$thePost = (mysqli_fetch_assoc($getLatestPostId));
	
	if($thePost['Id'] == null){
		echo "empty";
	}
	else{
		echo $thePost['Id'];
	}
		mysqli_close($conn);
}

?>