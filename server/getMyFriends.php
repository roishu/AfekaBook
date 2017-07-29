<?php 
	session_start();
	$myEmail = $_SESSION['email'];
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$myFriendsEmailQ="SELECT `friendEmail` FROM `friends` WHERE `userEmail` = '".$myEmail."'";
	$emailList= $conn->query($myFriendsEmailQ) or die($conn->error.__LINE__);
	
	
	$arr = array();
	if($emailList->num_rows > 0) {
		 while($row = $emailList->fetch_assoc()) {
		 	$myFriendsDetailsQ="SELECT `FirstName`, `LastName`, `Email` FROM `users` WHERE `Email` = '".$row["friendEmail"]."' ";
		 	$myFriendsList= $conn->query($myFriendsDetailsQ) or die($conn->error.__LINE__);
		 	$arr[] = $myFriendsList->fetch_assoc();
		 }
	}
	 
	echo $json_response = json_encode($arr);
	mysqli_close($conn);

?>


	