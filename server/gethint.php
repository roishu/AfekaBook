<?php
	session_start();
	$conn = new mysqli("localhost", "root", "tiger", "afekabookdb");
	$query="SELECT `Email`,`FirstName`,`LastName` FROM `users` ORDER BY 2";
	$result = $conn->query($query) or die($conn->error.__LINE__);
	$myEmail = $_SESSION['email'];
	$arr = array();
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			if($row["Email"]!=$myEmail)
				$arr[] = $row;
		}
	}
	
	// get the q parameter from URL
	$q = $_REQUEST["q"];
	$hint = array();
	
	// lookup all hints from array if $q is different from "" 
	if ($q !== "") {
		if ($q =="*"){
			foreach($arr as $name) 
				array_push($hint, array('firstName'=> "$name[FirstName]", 'lastName'=>"$name[LastName]", 'email' => "$name[Email]"));
		}
		else{
		   $q = strtolower($q);
		   $len=strlen($q);
		    foreach($arr as $name) {
		       if (stristr($q, substr($name["FirstName"], 0, $len)) || 
		        stristr($q, substr($name["LastName"], 0, $len))) {
		        	array_push($hint, array('firstName'=> "$name[FirstName]", 'lastName'=>"$name[LastName]", 'email' => "$name[Email]"));
		        }
		    } 
		}  
	}
	echo json_encode($hint);
	mysqli_close($conn);
?>