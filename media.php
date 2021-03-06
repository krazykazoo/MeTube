<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
include_once 'header.php';

	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media</title>
<script src="Scripts/AC_ActiveX.js" type="text/javascript"></script>
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
<style type="text/css">
.buttonz {
    background-color: #F66733; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
    width: 200px;
		margin: 1px;
}

.buttonz:hover {
    background-color: #522D80;
}
</style>
</head>

<body>

<?php
if(isset($_GET['id'])) {
	$query = "UPDATE Media SET views = views + 1 WHERE media_id = '".$_GET['id']."'";
	mysql_query($query);

	$query = "SELECT * FROM Media WHERE media_id='".$_GET['id']."'";
	$result = mysql_query( $query );
	$result_row = mysql_fetch_assoc($result);

	//updateMediaTime($_GET['id']);

	$filename=$result_row['name'];   ////0, 4, 2
	$filepath=$result_row['path'];
	$type=$result_row['type'];
	$media_id = $result_row['media_id'];
	$views = $result_row['views'];
	$uploader = $result_row['username'];
	$description = $result_row['description'];
	if(substr($type,0,5)=="image") //view image
	{
		echo "Viewing Picture: ";
		echo $result_row['title'];
		echo "<br />";
		echo "<img src='".$filepath."'/>";
		echo "<br />";
	}
	else //view movie
	{
		echo "Viewing Video: " . $result_row['title'];
?>
<br />
<video width="320" height="240" controls>
  <source src="<?php echo $filepath?>" type="video/mp4">
  <source src="<?php echo $filepath?>" type="video/ogg">
Your browser does not support the video tag.
</video>
<br />
<?php } ?>
	<table style="width:100%">
		<tr>
			<td style="width:20%"> User </td>
			<td style="width:80%"> Comment </td>
		</tr>
<?php
	$getComments = "SELECT * FROM Comment WHERE media_fk = '$media_id'";
	$commentResult = mysql_query($getComments);

	while ($row = mysql_fetch_assoc($commentResult)) {
		$user = $row['username'];
		$content = $row['content'];
		echo "<tr> <td style='width:20%'> $user </td> <td style=width:80%'> $content </td> </tr>";
	}

}
else
{
?>
	</table>
<meta http-equiv="refresh" content="0;url=browse.php">
<?php
}
?>
<span>Description: <?php echo $description; ?></span>
<span><em>&nbsp;&nbsp;&nbsp;&nbsp; Views: <?php echo $views; ?> </em></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp; Uploaded By: <?php echo $uploader; ?></span>
<p> Add to playlist? </p>
<form method="post" action="addPlaylist.php">
	<input type="hidden" name="media_id" value="<?php echo $media_id;?>">
	<span>Name of playlist: </span><input type="text" name="playlist_name">
	<input type="submit" value="Add to Playlist">
</form>
<p> Add to Favorites? </p> <br />
<form method="post" action="addFavorite.php">
	<input type="hidden" name="media_id" value="<?php echo $media_id;?>">
	<input class="buttonz" type="submit" value="Add to Favorites">
</form>
<p> Comments </p>
<table>
	<tr>
		<td>
			<form method="post" action="comment.php">
				<input type="hidden" name="media_id" value="<?php echo $media_id;?>">
				<span>Message: </span><input type="text" name="message" required>
				<input type="submit" value="Post Comment"></button>
			</form>
		</td>
	</tr>
</table>
</body>
</html>
