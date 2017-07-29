<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	//session_start();
	//$email=$_SESSION['email'];
	
	$date = date('Y-m-d H:i:s');
	$currentDate = strtotime($date);
	$futureDate = $currentDate-(60*5) + (60*60*3);
	$formatDate = date("Y-m-d H:i:s", $futureDate);
	
	
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
///////////////
//$getLatestPostIdQ = "SELECT MAX(Id) as Id, ThePost, Date FROM `posts` WHERE `Date` > '".$formatDate."' and ThePost like '%tal%'";
		//$getLatestPostId=$conn->query($getLatestPostIdQ);
		//$postId = (mysqli_fetch_assoc($getLatestPostId));
/////////////////	
	
	
	$data = json_decode(file_get_contents("php://input"));
	$email = $data->email;
	$post = $data->post;
	$privacy = $data->privacy;
	$src = $data->src;
	
	
	
	$conn->query("INSERT INTO posts(ThePost, Publisher, Privacy) VALUES('".$post."', '".$email."', '".$privacy."')");
	
	// get max post ID
	$getLatestPostIdQ = "SELECT MAX(Id) as Id, ThePost,Publisher, Date FROM `posts`";
	$getLatestPostId=$conn->query($getLatestPostIdQ);
	$postId = (mysqli_fetch_assoc($getLatestPostId));
	
		
	$addPicToGallayQ = "INSERT INTO `gallery` (`Publisher`, `Src`, `PostId`) VALUES('".$email."','"."".$src."', '".$postId['Id']."')";
	$conn->query($addPicToGallayQ);



	
	
	//$currentDateTime = $conn->insert_id;
	//echo $postId['ThePost']."\n";
	//echo $postId['Id'];
	//echo $PostId;
	mysqli_close($conn);
}

?>