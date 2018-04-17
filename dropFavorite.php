<?php 
	include_once 'header.php';
	include_once 'function.php';
	if (isset($_POST['media_id'])) {
		$media_id = $_POST['media_id'];
		$getUserId = "SELECT * FROM Account WHERE username = '".$_SESSION['username']."'";
		$userResult = mysql_query($getUserId);
		$row = mysql_fetch_assoc($userResult);
		$userId = $row['account_id'];
		$query = "DELETE FROM Favorites WHERE user_fk = '$userId' AND media_fk = '$media_id'";
		$result = mysql_query($query);
		if ($result) {
			//header("Location: favorites.php");	
		}
	}
	else {
		echo "oops";
	}


?>