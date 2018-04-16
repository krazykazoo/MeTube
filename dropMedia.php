<?php 
	include_once 'header.php';
	include_once 'function.php';
	if (isset($_GET['playlist_name']) &&
		isset($_GET['id'])) {
		$name = $_GET['playlist_name'];
		$media_id = $_GET['id'];
		$getUserId = "SELECT * FROM Account WHERE username = '".$_SESSION['username']."'";
		$userResult = mysql_query($getUserId);
		$row = mysql_fetch_assoc($userResult);
		$userId = $row['account_id'];
		$query = "DELETE FROM Playlist WHERE user_fk = '$userId' AND playlist_name = '$playlist_name' AND media_fk = '$media_id'";
		$result = mysql_query($query);
		
		if ($result) {
			echo "success";
		}
		else {
			echo "oops";
		}
	}


?>