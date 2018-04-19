<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
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
    width: 150px;
		margin: 1px;
}

.buttonz:hover {
    background-color: #522D80;
}
</style>
</head>
<?php
	include_once 'header.php';
	include_once "function.php";

	if (!isset($_GET['id'])) {
		$getUserId = "SELECT * FROM Account WHERE username = '".$_SESSION['username']."'";
		$userResult = mysql_query($getUserId);
		$row = mysql_fetch_assoc($userResult);
		$userId = $row['account_id'];
		$query = "SELECT * FROM Playlist WHERE user_fk = '$userId' ORDER BY id LIMIT 1";
		$result = mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$media_id = $row['media_fk'];
			$next_media = $row['next_media_fk'];
			$playlist_name = $row['playlist_name'];

		}
	}
	else {
		$media_id = $_GET['id'];
		$query = "SELECT * FROM Playlist WHERE media_fk = '$media_id' ORDER BY id DESC LIMIT 1";
		$result = mysql_query($query);
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_assoc($result);
			$next_media = $row['next_media_fk'];
			$playlist_name = $row['playlist_name'];
		}
	}
	if (mysql_num_rows($result) > 0) {
	$query = "UPDATE Media SET views = views + 1 WHERE media_id = '$media_id'";
	mysql_query($query);

	$query = "SELECT * FROM Media WHERE media_id = '$media_id'";
	$result = mysql_query( $query );
	$result_row = mysql_fetch_assoc($result);

	$filename=$result_row['name'];   ////0, 4, 2
	$filepath=$result_row['path'];
	$type=$result_row['type'];
	$media_id = $result_row['media_id'];
	$views = $result_row['views'];
	$uploader = $result_row['username'];
	if(substr($type,0,5)=="image") //view image
	{
		echo "Viewing Picture: ";
		echo $result_row['title'];
		echo "<br />";
		echo "<img src='".$filepath."'/>";
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
<span><em>Views: <?php echo $views; ?> </em></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp; Uploaded By: <?php echo $uploader; ?></span>
<br />


<?php } ?>

 <?php if ($next_media != 0) { ?>
<a href="playlist.php?id=<?php echo $next_media;?>"><button class="buttonz" type="button">Next</button></a>
<?php
	}
	else {?>
<br />
<span><em>Views: <?php echo $views; ?> </em></span>
<span>&nbsp;&nbsp;&nbsp;&nbsp; Uploaded By: <?php echo $uploader; ?></span>
<br />
<a href="playlist.php"><button class="buttonz" type="button">Beginning</button></a>
<?php } ?>
	<table style="width:100%">
		<tr>
			<td style="width:20%"> User </td>
			<td style="width:80%"> Comment </td>
		</tr>
		<a href="dropMedia.php?id=<?php echo $media_id; ?>&playlist_name=<?php echo $playlist_name; ?>"><button class="buttonz" type="button">Remove</button></a>
		<a href="<?php echo $filepath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4];?>);"><button class="buttonz" type="button">Download</button></a>

<?php
	$getComments = "SELECT * FROM Comment WHERE media_fk = '$media_id'";
	$commentResult = mysql_query($getComments);

	while ($row = mysql_fetch_assoc($commentResult)) {
		$user = $row['username'];
		$content = $row['content'];
		echo "<tr> <td style='width:20%'> $user </td> <td style=width:80%'> $content </td> </tr>";
	}
?>



<p> Post Comment </p>
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
<?php } ?>

</html>
