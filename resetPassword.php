<?php
	include_once 'header.php';
	include_once 'function.php';
	if (isset($_POST['old_password']) &&
		isset($_POST['new_password1']) &&
		isset($_POST['new_password2'])) {
		
		$username = $_SESSION['username'];
		$getOldPassword = "SELECT * FROM Account WHERE username = '$username'";
		$passwordResult = mysql_query($getOldPassword);
		if (mysql_num_rows($passwordResult) > 0) {
			$row = mysql_fetch_assoc($passwordResult);
			$oldPasswordHash = $row['password'];
		}	
		$password = $_POST['old_password'];
		$newPassword1 = $_POST['new_password1'];
		$newPassword2 = $_POST['new_password2'];
		if (password_verify($password, $oldPasswordHash)) {
			if ($newPassword1 === $newPassword2) {
				$newPasswordHash = password_hash($newPassword1);
				$updatePassword = "UPDATE Account SET password = '$newPasswordHash' WHERE username = '$username'";
				$result = mysql_query($updatePassword);
				if ($result) {
					header("Location: profile.php");
				}
				else {
					echo "update failed";
				}
			}
			else {
				echo "new password mismatch";
			}
		}
		else {
			echo "bad password";
		}		
	}
?>