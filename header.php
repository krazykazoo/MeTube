<?php 

ini_set('session.save_path', '/home/kpascia/sessions');
ini_set('session.gc_probability', 1);
session_start();

function logout() {
	session_unset(); 
	header("Location: index.php");
}

if (isset($_SESSION['username'])) {
	echo '<form method = "post" action = "<?php logout(); ?>"> <input type="submit" value="Logout"> </form>';
}




?>