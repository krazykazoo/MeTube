<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

<?php 

include_once 'header.php'
echo "Messages";


if (isset($_POST['submit'])) {
	if (!isset($_POST['recipient']) ||
		!isset($_POST['message'])) {
		echo "Argument error.";
	}
	else {
		$recipient = $_POST['recipient'];
		$message = $_POST['message'];
		
		$result = mysql_query("SELECT account_id FROM Account WHERE username = '$recipient')";
		if (mysql_num_rows($result) > 0) {
			$to_fk = mysql_fetch_assoc($result);
			$query = "INSERT INTO Message (to_fk, from, content) VALUES ('$to_fk', '". $_SESSON['username']. "', '$message')";
			$insertResult = mysql_query($query);
			if (mysql_num_rows($insertResult) > 0) {
				echo "message sent";
			}
			else {
				echo "send error";
			}
		}
		else {
			echo "this user doesnt exist.";
		}
	}
	
	
	
	
}





?>
