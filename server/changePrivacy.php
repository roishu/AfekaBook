<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	session_start();
	$data = json_decode(file_get_contents("php://input"));
 	$postId = $data->postId;
	$privacy = $data->privacy;
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$setNewPrivacyQ = "UPDATE `posts` SET `Privacy` = '".$privacy."' WHERE `Id` = $postId";
	$conn->query($setNewPrivacyQ) or die($conn->error.__LINE__); 
	mysqli_close($conn);
}

?>