<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php

ini_set('session.save_path', '/home/kpascia/sessions');
ini_set('session.gc_probability', 1);
session_start();

if (isset($_SESSION['username'])) {
	echo '<form method = "post" action = "logout.php"> <input type="submit" value="Logout"> </form>';
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">
<!--

 #navbar ul {
	margin: 0;
	padding: 5px;
	list-style-type: none;
	text-align: center;
	background-color: #000;
	}

#navbar ul li {
	display: inline;
	}

#navbar ul li a {
	text-decoration: none;
	padding: .2em 1em;
	color: #fff;
	background-color: #000;
	}

#navbar ul li a:hover {
	color: #000;
	background-color: #fff;
	}

-->
</style>
</head>
<body>
<div id="navbar">
  <ul>
	<li><a href="http://github.com">Home</a></li>
	<li><a href="http://github.com">Browse</a></li>
	<li><a href="http://github.com">Friends</a></li>
	<li><a href="http://github.com">Login</a></li>
	<li><a href="http://github.com">Log Out</a></li>
  </ul>
</div>
</body>
</html>
