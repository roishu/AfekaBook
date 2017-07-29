<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	session_start();
	$email=$_SESSION['email'];
	$postId = 
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$getMyGalleryQ = "SELECT `Src` FROM `gallery` WHERE `Publisher` = '".$email."' AND `PostId` = $postId" ;
	$getMyGallery = $conn->query($getMyGalleryQ) or die($conn->error.__LINE__);
	
	$out = array();
	if($getMyGallery->num_rows > 0) {
		while($row = mysqli_fetch_assoc($getMyGallery)) {
			array_push($out, array('src' => $row["Src"])); //push the post obj	
		}
	}
	echo json_encode($out);
	mysqli_close($conn);
}
?>