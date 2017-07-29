<?php

	session_start();
	$myEmail = $_SESSION['email'];
	$friemdEmail = $_REQUEST["q"];

	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$conn->query("DELETE from `friends` WHERE userEmail ='".$myEmail."' AND friendEmail ='".$friemdEmail."'") or die($conn->error.__LINE__);
	echo json_encode("DELETE from `friends` WHERE userEmail ='".$myEmail."' AND friendEmail ='".$friemdEmail."'");
	mysqli_close($conn);
?>