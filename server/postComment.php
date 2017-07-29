<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	session_start();
	$data = json_decode(file_get_contents("php://input"));
	$postId = $data->postId;
	$publisher = $data->publisher;
	$comment = $data->comment;
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$addCommentQ= "INSERT INTO comments(PostId, Publisher, Comment)VALUES($postId, '".$publisher."', '".$comment."')";
	$conn->query($addCommentQ);
	echo $addCommentQ;
	mysqli_close($conn);
}

?>