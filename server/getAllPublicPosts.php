<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	session_start();
	$myEmail = $_SESSION['email'];
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$getAllpostQ = "SELECT * FROM `posts` WHERE `Privacy` = 'public' OR `Publisher` = '".$myEmail."' ORDER BY `Date` DESC "; 
	$allPosts= $conn->query($getAllpostQ) or die($conn->error.__LINE__);
	
	$out = array();
	if($allPosts->num_rows > 0) {
		while($row = mysqli_fetch_assoc($allPosts)) {
			$isMyFriendQ = "SELECT * FROM `friends` WHERE `userEmail` = '".$myEmail."' AND `friendEmail` = '".$row["Publisher"]."' ";
			$isMyFriend = $conn->query($isMyFriendQ) or die($conn->error.__LINE__);
			if($isMyFriend->num_rows > 0 || $row["Publisher"]==$myEmail){
				$photos = array();
	 			$getOwnerNameQ = "SELECT `FirstName`, `LastName` FROM `users` WHERE `Email` = '".$row["Publisher"]."' ";
				$getOwnerName = mysqli_fetch_row($conn->query($getOwnerNameQ));
	
				$getPostsPhotosSrcQ = "SELECT `Src`, `Thumb` FROM `gallery` WHERE `PostId` = $row[Id]" ;
				$getPostsPhotosSrc = $conn->query($getPostsPhotosSrcQ) or die($conn->error.__LINE__);
				if($getPostsPhotosSrc->num_rows > 0) {
					while($photo = mysqli_fetch_assoc($getPostsPhotosSrc)) {
						array_push($photos, array('src' => $photo["Src"], 'thumb' => $photo["Thumb"] )); 
					}
				}
				array_push($out, array('firstName' => $getOwnerName[0], 'lastName' => $getOwnerName[1], 'thePost' => $row, 'photos' => $photos )); //push the post obj	
			}
		}
	}
	echo json_encode($out);
	mysqli_close($conn);
}


?>