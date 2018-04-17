<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	ini_set('session.save_path', 'sessions');
	ini_set('session.gc_probability', 1);
	session_start();
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
	<li><a href="index.php">Home</a></li>
	<li><a href="browse.php">Browse</a></li>
	<?php if (isset($_SESSION['username'])) {
			echo "<li><a href='message.php'>Messages</a></li>";
			echo "<li><a href='playlist.php'>My Playlist</a></li>";
			echo "<li><a href='channel.php'>My Channel</a></li>";
			echo "<li><a href='contacts.php'>My Contacts</a></li>";
			echo "<li><a href='favorites.php'>Favorites</a></li>";
			echo "<li><a href='logout.php'>Log Out</a></li>";
			
		}
	    else echo "<li><a href='login.php'>Login</a></li><li><a href='register.php'>Register</a></li>";
	?>
	<li>
		<form method="post" action="search.php">
			<input type="text" value="search" onclick="value=''" name="search">
			<input type="submit">
		</form>
  </ul>
</div>
</body>
</html>
