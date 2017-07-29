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
	
	$thePost['Publisher'];
	
	$getNameQ = "SELECT FirstName, LastName FROM users where email = '".$thePost['Publisher']."'";
	$getNameQ = $conn->query($getNameQ);
	$theNames = (mysqli_fetch_assoc($getNameQ));
	
	$query2 = "SELECT MAX(Id) as Id, ThePost,Publisher, Date FROM `posts`";
	$query2 = $conn->query($query2);
	$theMaxIDPOST = (mysqli_fetch_assoc($query2));
		
	//$data = json_decode(file_get_contents("php://input"));
	//$email = $data->email;
	//$post = $postId['ThePost']."\n".$email.":\n".$data->post;
	//$privacy = $data->privacy;
	
	//$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	
	
	//$conn->query("INSERT INTO posts(ThePost, Publisher, Privacy) VALUES('".$post."', '".$email."', '".$privacy."')");

	//$currentDateTime = $conn->insert_id;
	echo $thePost['ThePost']."\n";
	echo $thePost['Id']."\n";
	echo $theNames['FirstName']." ".$theNames['LastName']."\n";
	echo $theMaxIDPOST['Id'];
	mysqli_close($conn);
}

?>