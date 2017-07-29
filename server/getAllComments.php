<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	session_start();
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$getAllCommentsQ = "SELECT * FROM `comments` ORDER BY `Date` ASC";
	$allComments= $conn->query($getAllCommentsQ) or die($conn->error.__LINE__);
	
	$arr = array();
	$out = array();
	if($allComments->num_rows > 0) {
		while($row = mysqli_fetch_assoc($allComments)) {
 			$getOwnerNameQ = "SELECT `FirstName`, `LastName` FROM `users` WHERE `Email` = '".$row["Publisher"]."' ";
			$getOwnerName = mysqli_fetch_row($conn->query($getOwnerNameQ));

			array_push($out, array('firstName' => $getOwnerName[0], 'lastName' => $getOwnerName[1], 'theComment' => $row)); //push the post obj	
		}
	}
	echo json_encode($out);
	mysqli_close($conn);
}
?>