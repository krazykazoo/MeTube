<?php 
	include_once 'header.php';
	include_once 'function.php';
	echo "My Account";
?>


<form method="post" action="resetPassword.php"> 
	<table>
		<tr>
			<td><p>Current Password: </p></td>
			<td><input type="password" name="old_password" required></td>
		</tr>
		<tr>
			<td><p>New Password: </p></td>
			<td><input type="password" name="new_password1" required></td>
		</tr>
		<tr>
			<td><p>Confirm Password: </p></td>
			<td><input type="password" name="new_password2"required></td>
		</tr>
	</table>
</form>