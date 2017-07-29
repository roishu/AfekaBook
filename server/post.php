<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	session_start();
	$email=$_SESSION['email'];
	$data = json_decode(file_get_contents("php://input"));
	$post = $data->post;
	$privacy = $data->privacy;
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$conn->query("INSERT INTO posts(ThePost, Publisher, Privacy) VALUES('".$post."', '".$email."', '".$privacy."')");
	$PostId = $conn->insert_id;
	echo $PostId;
	mysqli_close($conn);
	
}

?>