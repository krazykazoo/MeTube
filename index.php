<html>
<body>
<?php
ini_set('session.save_path', '/home/kpascia/sessions');
ini_set('session.gc_probability', 1);

echo "<h1> Welcome to Metube! </h1>";
?>

<form action="login.php" method="post">
	
	<input type="submit" class="button"  VALUE = "Log in" >
</form>

<form action="register.php" method="post">
	
	<input type="submit" class="button"  VALUE = "Register" >
</form>

</body>
</html>
