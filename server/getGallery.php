<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	session_start();
	$email=$_SESSION['email'];
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$getMyGalleryQ = "SELECT * FROM `gallery` WHERE `Publisher` = '".$email."'";
	$getMyGallery = $conn->query($getMyGalleryQ) or die($conn->error.__LINE__);
	
	$out = array();
	if($getMyGallery->num_rows > 0) {
		while($row = mysqli_fetch_assoc($getMyGallery)) {
			array_push($out, array('src' => $row["Src"] , 'thumb' => $row["Thumb"])); //push the post obj	
		}
	}
	echo json_encode($out);
	mysqli_close($conn);
}	
?>