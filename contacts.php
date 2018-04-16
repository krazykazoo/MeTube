<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include_once 'header.php';
	include_once "function.php";
?>
	<table>
		<tr>
			<td> Contacts </td> <td> Channel </td>
		</tr>
		<?php
		$getUserId = "SELECT * FROM Account WHERE username = '".$_SESSION['username']."'";
		$userResult = mysql_query($getUserId);
		$row = mysql_fetch_assoc($userResult);
		$userId = $row['account_id'];
		$query = "SELECT * FROM Contact WHERE user_fk = '$userId'";
		$result = mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			while ($row = mysql_fetch_assoc($result)) {
				$user_fk = $row['user_fk'];
				$getUserId = "SELECT * FROM Account WHERE account_id = '$user_fk'";
				$userResult = mysql_query($getUserId);
				$row = mysql_fetch_assoc($userResult);
				$username = $row['username'];
				echo "<tr><td>$username</td><td><a href='channel.php?id=$user_fk'>Link</a></td></tr>"
			}
		}
		
		?>
	</table>


<p> Add a Contact </p>
<table>
	<tr>
		<td>
			<form method="post" action="addContact.php">
				<span>User: </span><input type="text" name="user" required>
				<input type="submit" value="Send"></button>
			</form>
		</td>
	</tr>
</table>





<?php
?>
</html>