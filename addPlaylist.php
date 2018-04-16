<?php 
	include_once 'header.php';
	include_once 'function.php';
	if (isset($_POST['playlist_name']) &&
		isset($_POST['media_id'])) {
		$name = $_POST['playlist_name'];
		$media_id = $_POST['media_id'];
		$getUserId = "SELECT * FROM Account WHERE username = '".$_SESSION['username']."'";
		$userResult = mysql_query($getUserId);
		$row = mysql_fetch_assoc($userResult);
		$userId = $row['account_id'];
		$query = "INSERT INTO Playlist (playlist_name, user_fk, media_fk) VALUES ('$name', '$userId', '$media_id')";
		$result = mysql_query($query);
		if ($result) {
			header("Location: media.php?id=$media_id");	
		}
	}
	else {
		echo "oops";
	}


?>