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
		$query = "SELECT * FROM Playlist WHERE user_fk = '$userId' ORDER BY id DESC LIMIT 1";
		$result = mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$last_media = $row['media_id'];
			$query = "UPDATE Playlist SET next_media_fk = '$media_id' WHERE playlist_name = '$name' AND user_id = '$userId' AND media_fk = '$last_media'";
			mysql_query($query);
		}
		
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