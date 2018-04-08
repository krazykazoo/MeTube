<?php 

ini_set('session.save_path', '/home/kpascia/sessions');
ini_set('session.gc_probability', 1);
session_start();

if (isset($_SESSION['username'])) {
	echo '<input type="button" action="<?php session_destroy(); header('index.php');?>" value="Logout">';
}
?>

