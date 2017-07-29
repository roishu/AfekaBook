<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)){
	session_start();
	$email = $_SESSION['email'];
	//create directory for user
	if (!is_dir("users")) {
		@mkdir("users");
	}
	if (!is_dir("users/".$email)) {
	    @mkdir("users/".$email);
	}
	
	$target_path = "users/".$email."/";
	$target_path = $target_path . basename( $_FILES['file']['name']);
	
	if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)){
		$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
		$profilePicUpdate = "UPDATE users SET ProfilePic='"."server/".$target_path."' WHERE `email`='".$email."'";
		$conn->query($profilePicUpdate);
	    echo "The file ".  basename( $_FILES['file']['name']). " has been uploaded";
	} else{
	    echo "There was an error uploading the file, please try again!";
	}
	mysqli_close($conn);
	
}
?>