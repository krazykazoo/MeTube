<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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


<?php } ?>
 
 <?php if ($next_media != 0) { ?>
<a href="playlist.php?id=<?php echo $next_media;?>">Next</a>
<?php 
	}
	else {?>
<a href="playlist.php">Beginning</a>
<?php } ?>
	<table style="width:100%">
		<tr>
			<td style="width:20%"> User </td>
			<td style="width:80%"> Comment </td>
		</tr>
	<a href="dropMedia.php?<?php echo 'id=$media_id&playlist_name=$playlist_name'; ?>">Remove</a>
		          
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
				<input type="submit" value="Send"></button>
			</form>
		</td>
	</tr>
</table>
<?php } ?>

</html>