<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	session_start();
	$data = json_decode(file_get_contents("php://input"));
	$arr = array();
	$postId = $data->postId;
	$publisher = $data->publisher;
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$isExistsQ = "SELECT * FROM likes WHERE `Publisher` = '$publisher' AND `PostId` = $postId";
	$getNumOfLikesQ = "SELECT COUNT(PostId) AS numOfLikes FROM `likes` WHERE `PostId` = $postId";
	$isExists = $conn->query($isExistsQ) or die($conn->error.__LINE__);
	
 	if($isExists->num_rows == 0){ //add new like
		$addNewLike = "INSERT INTO likes(`Publisher`, `PostId`)VALUES('".$publisher."', $postId)";
		$conn->query($addNewLike) or die($conn->error.__LINE__);
	}
	else{ // remove the like
		$removeLike = "DELETE FROM `likes` WHERE `Publisher` = '$publisher' AND `PostId` = $postId";
		$conn->query($removeLike) or die($conn->error.__LINE__);
	} 
	// update num of likes in posts table where Id==PostId
	$getNumOfLikes = $conn->query($getNumOfLikesQ) or die($conn->error.__LINE__);
	$row = mysqli_fetch_assoc($getNumOfLikes);
	$updateLikesQ = "UPDATE `posts` SET `Likes` = $row[numOfLikes] WHERE Id = $postId";
	$conn->query($updateLikesQ) or die($conn->error.__LINE__);
	if($row['numOfLikes']>0)
		echo json_encode($row);
	else
		echo 0;
	
	mysqli_close($conn);
}
?>