<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	ini_set('session.save_path', 'sessions');
	ini_set('session.gc_probability', 1);
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style type="text/css">

.selected
{
	float: left !important;
}

.searchbar
{
	padding-top: 5px;
	padding-right: 100px;
}
 #navbar ul {
	margin: 0;
	padding: 5px;
	list-style-type: none;
	text-align: center;
	background-color: #522D80;
	height: 45px;
	}

#navbar ul li {
	display: inline;
	}

#navbar ul li a {
	text-decoration: none;
	padding: .2em 1em;
	color: #fff;
	background-color: #522D80;
	}

#navbar ul li a:hover {
	background-color: #F66733;
	}


</style>
</head>
<body>
<div id="navbar">
  <ul>
	<a href="browse.php"><li class="selected"><img src="https://cdn-static.metube.id/covers/channels/aWMuKfyb9Gm61WuCSVGY.png" height="45" width="200"/></li></a>
	<li><a href="browse.php">Browse</a></li>
	<?php if (isset($_SESSION['username'])) {
			echo "<li><a href='message.php'>Messages</a></li>";
			echo "<li><a href='playlist.php'>My Playlist</a></li>";
			echo "<li><a href='channel.php'>My Channel</a></li>";
			echo "<li><a href='contacts.php'>My Contacts</a></li>";
			echo "<li><a href='favorites.php'>Favorites</a></li>";
			echo "<li><a href='profile.php'>My Account</a></li>";
			echo "<li><a href='logout.php'>Log Out</a></li>";

		}
	    else echo "<li><a href='login.php'>Login</a></li><li><a href='register.php'>Register</a></li>";
	?>
	<li>
		<form class="searchbar" method="post" action="search.php">
			<input type="text" value="search" onclick="value=''" name="search">
			<input type="submit">
		</form>
  </ul>
</div>
</body>
</html>
