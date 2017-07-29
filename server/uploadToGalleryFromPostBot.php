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
	if (!is_dir("users/".$email."/gallery")) {
		@mkdir("users/".$email."/gallery");
	}
	
	if (!is_dir("users/".$email."/gallery/thumb")) {
		@mkdir("users/".$email."/gallery/thumb");
	}
	
	/*
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");

	$getLatestPostIdQ = "SELECT max(Id) AS Id FROM `posts` WHERE `Publisher` = '".$email."'";
		
		$getLatestPostId=$conn->query($getLatestPostIdQ);
		$postId = (mysqli_fetch_assoc($getLatestPostId));
	
	$addPicToGallayQ = "INSERT INTO `gallery` (`Publisher`, `Src`, `Thumb`, `PostId`) VALUES('".$postId['Id']."','yot','yot', '".$postId['Id']."')";
	
	$conn->query($addPicToGallayQ);
*/
	
	
	
	$target_path = "users/".$email."/gallery/";
	$target_path = $target_path . basename( $_FILES['file']['name']);
	$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
	
	if(move_uploaded_file($_FILES['file']['tmp_name'], $target_path)){
		$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
		
		$getLatestPostIdQ = "SELECT max(Id) AS Id FROM `posts` WHERE `Publisher` = '".$email."'";
		$getLatestPostId=$conn->query($getLatestPostIdQ);
		$postId = (mysqli_fetch_assoc($getLatestPostId));
		if($ext=='jpg' || $ext=='jpeg'){
			$thumbDest = "users/".$email."/gallery/thumb" . basename( $_FILES['file']['name']);
			make_thumb($target_path, $thumbDest, 50);
			$addPicToGallayQ = "INSERT INTO `gallery` (`Publisher`, `Src`, `Thumb`, `PostId`) VALUES('".$email."','"."server/".$target_path."','"."server/".$thumbDest."', '".$postId['Id']."')";
			//echo $addPicToGallayQ;
		}
		else
			$addPicToGallayQ = "INSERT INTO `gallery` (`Publisher`, `Src`, `PostId`) VALUES('".$email."','"."server/".$target_path."', '".$postId['Id']."')";
		$conn->query($addPicToGallayQ);
	
		echo "The file ".  basename( $_FILES['file']['name']). " has been uploaded";
	} else{
	    echo "There was an error uploading the file, please try again!";
	}
	
	mysqli_close($conn);
}
function make_thumb($src, $dest, $desired_width) {
	
		/* read the source image */
		$source_image = imagecreatefromjpeg($src);
		$width = imagesx($source_image);
		$height = imagesy($source_image);
	
		/* find the "desired height" of this thumbnail, relative to the desired width  */
		$desired_height = floor($height * ($desired_width / $width));
	
		/* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($desired_width, $desired_height);
	
		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $source_image, 0, 0, 0, 0, $desired_width, $desired_height, $width, $height);
	
		/* create the physical thumbnail image to its destination */
		imagejpeg($virtual_image, $dest);
	}
?>