<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<style type="text/css">
	#messages {
	    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	    border-collapse: collapse;
	}

	#messages td, #messages th {
	    border: 1px solid #ddd;
	    padding: 8px;
	}

	#messages tr:nth-child(even) {
		background-color: #f2f2f2;
	}

	#messages tr:hover {
		background-color: #ddd;
	}

	#messages th {
	    padding-top: 12px;
	    padding-bottom: 12px;
	    text-align: left;
			padding-left: 12px;
	    background-color: #F66733;
	    color: white;
	}
</style>
</head>
<?php

	include_once 'header.php';
	include_once 'function.php';
	echo "<p>My Messages</p>";
	?>
	<table id="messages" style="width:100%">
		<tr>
			<th style="width:20%"> Recieved From </th>
			<th style="width:80%"> Message </th>
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
	<table id="messages" style="width:100%";>
		<tr>
			<th style="width:20%"> Sent To </th>
			<th style="width:80%"> Message </th>
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
