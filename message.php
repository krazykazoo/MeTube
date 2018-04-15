<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php 

	include_once 'header.php';
	include_once 'function.php';
	echo "Messages";


	if (!isset($_POST['recipient']) ||
		!isset($_POST['message'])) {
		echo "Argument error.";
	}
	else {
		$recipient = $_POST['recipient'];
		$message = $_POST['message'];
		
		$accountCheck = "SELECT account_id FROM Account WHERE username = '$recipient'";
		$recipientResult = mysql_query($accountCheck);
		if (!$recipientResult) {
			echo "user not found";
		}
		else {
			$row = mysql_fetch_assoc($recipientResult);
			$to_fk = $row['account_id'];
			echo $to_fk;
			$username = $_SESSION['username'];
			echo $username;
			echo $message;
			$query = "INSERT INTO Message (to_fk, from, content) VALUES ('$to_fk', '$username', '$message')";
			$insertResult = mysql_query($query);
			if ($insertResult) {
				echo "message sent";
			}
			else {
				echo "send error";
			}
		}	
	}
?>



<table>
	<tr>
		<td>
			<form method="post" action="message.php">
				<span>To user: </span><input type="text" name="recipient" required>
				<span>Message: </span><input type="text" name="message" required>
				<input type="submit" value="Send">Send</button>
			</form>
		</td>
	</tr>
</table>


</html>