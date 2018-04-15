<?php 
	if (isset($_POST['message']) &&
		isset($_POST['media_id'])) {
		$content = $_POST['message'];
		$media_id = $_POST['media_id'];
		$username = $_SESSION['username'];
		$query = "INSERT INTO Comment (media_fk, username, content) VALUES ('$media_id', '$username', '$content')";
		$result = mysql_query($query);
		if ($result) {
			header("Location: media.php?id=$media_id");	
		}
	}
	else {
		echo "oops";
	}


?>