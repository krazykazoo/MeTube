<?php 
	include_once 'header.php';
	include_once 'function.php';
	if (isset($_POST['media_id'])) {
		$media_id = $_POST['user'];
		$getUserId = "SELECT * FROM Account WHERE username = '".$_SESSION['username']."'";
		$userResult = mysql_query($getUserId);
		$row = mysql_fetch_assoc($userResult);
		$userId = $row['account_id'];
		$query = "INSERT INTO Favorites (user_fk, media_fk) VALUES ('$userId', '$media_id')";
		$result = mysql_query($query);
		if ($result) {
			header("Location: media.php?id=$media_id");	
		}
	}
	else {
		echo "oops";
	}


?>