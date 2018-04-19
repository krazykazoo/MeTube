<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php

	include_once 'header.php';
	include_once 'function.php';
	echo "<p>My Messages</p>";
	?>
	<table style="width:100%">
		<tr>
			<td style="width:20%"> Recieved From </td>
			<td style="width:80%"> Message </td>
		</tr>
		<?php
			$getUserId = "SELECT * FROM Account WHERE username = '". $_SESSION['username'] . "'";
			$userResult = mysql_query($getUserId);
			$row = mysql_fetch_assoc($userResult);
			$user = $row['account_id'];
			$getMessages = "SELECT * FROM Message WHERE to_fk = $user";
			$messagesResult = mysql_query($getMessages);
			while ($row = mysql_fetch_assoc($messagesResult)) {
				$sender = $row['sender'];
				$content = $row['content'];
				echo "<tr> <td style='width:20%'> $sender </td> <td style=width:80%'> $content </td> </tr>";
			}


		?>
	</table>
	<br>
	<table style="width:100%";>
		<tr>
			<td style="width:20%"> Sent To </td>
			<td style="width:80%"> Message </td>
		</tr>
		<?php
			$getrecMessages = "SELECT * FROM Message WHERE sender = '". $_SESSION['username'] ."'";
			$recidResult = mysql_query($getrecMessages);
			$row = mysql_fetch_assoc($recidResult);
			$recidResult = mysql_query($getrecMessages);
			while ($row = mysql_fetch_assoc($recidResult)) {
				$receiverid = $row['to_fk'];
				$content = $row['content'];
				$getreceivername = "SELECT * FROM Account WHERE account_id = $receiverid";
				$receiverresult = mysql_query($getreceivername);
				$row = mysql_fetch_assoc($receiverresult);
				$receivername = $row['username'];
				echo "<tr> <td style='width:20%'> $receivername </td><td style='width:80%'> $content </td> </tr>";
			}


		?>
	</table>
	<?php
	if (isset($_POST['recipient']) &&
		isset($_POST['message'])){
		$recipient = $_POST['recipient'];
		$message = $_POST['message'];

		$accountCheck = "SELECT account_id FROM Account WHERE username = '$recipient'";
		$recipientResult = mysql_query($accountCheck);
		if (!$recipientResult) {
			echo "<script type='text/javascript'>alert('Sorry there is no user named: $recipient');</script>";
		}
		else {
			$row = mysql_fetch_assoc($recipientResult);
			$to_fk = $row['account_id'];
			$username = $_SESSION['username'];
			$query = "INSERT INTO Message (to_fk, sender, content) VALUES ('$to_fk', '$username', '$message')";
			$insertResult = mysql_query($query);
			if ($insertResult) {
				echo "<script type='text/javascript'>alert('Message Sent!');</script>";
			}
			else {
				echo "<script type='text/javascript'>alert('Message Failed to Send!');</script>";
			}
			unset($_POST['recipient']);
			unset($_POST['message']);
			header('Location: message.php');
		}
	}
?>


<p> Send A Message </p>
<table>
	<tr>
		<td>
			<form method="post" action="message.php">
				<span>To user: </span><input type="text" name="recipient" required>
				<span>Message: </span><input type="text" name="message" required>
				<input type="submit" value="Send"></button>
			</form>
		</td>
	</tr>
</table>


</html>
