<?php 
	include_once 'header.php';
	include_once 'function.php';
	if (isset($_POST['user'])) {
		$user = $_POST['message'];
		$getUserId = "SELECT * FROM Account WHERE username = '".$_SESSION['username']."'";
		$userResult = mysql_query($getUserId);
		$row = mysql_fetch_assoc($userResult);
		$userId = $row['account_id'];
		$getContactId = "SELECT * FROM Account WHERE username = '$user'";
		$contactResult = mysql_query($getContactId);
		$row = mysql_fetch_assoc($contactResult);
		$contactId = $row['account_id'];
		$query = "INSERT INTO Contact (user_fk, contact_fk) VALUES ('$userId', '$conatctId')";
		$result = mysql_query($query);
		if ($result) {
			header("Location: contacts.php");	
		}
	}
	else {
		echo "oops";
	}


?>