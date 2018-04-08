<html>
<body>

<?php
ini_set('session.save_path', '/home/kpascia/sessions');
ini_set('session.gc_probability', 1);

session_start();

include_once "function.php";

if(isset($_POST['submit'])) {
	if( $_POST['passowrd1'] != $_POST['passowrd2']) {
		$register_error = "Passwords don't match. Try again?";
	}
	else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
		$register_error = "Invalid email address!";
	}
	else {
		$check = user_exist_check($_POST['username'], $_POST['passowrd1'], $_POST['email']);	
		if($check == 1){
			//echo "Register succeeds";
			$_SESSION['username']=$_POST['username'];
			header('Location: browse.php');
		}
		else if($check == 2){
			$register_error = "Username already exists. Please user a different username.";
		}
	}
}

?>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
	Email Address: <input type="text" name="email" required> <br>
	Username: <input type="text" name="username" required> <br>
	Create Password: <input  type="password" name="passowrd1" required> <br>
	Repeat password: <input type="password" name="passowrd2" required> <br>
	<input name="submit" type="submit" value="Submit">
</form>

<?php
  if(isset($register_error))
   {  echo "<div id='passwd_result'> register_error:".$register_error."</div>";}
?>

</body>
</html>
