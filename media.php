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
	if(substr($type,0,5)=="image") //view image
	{
		echo "Viewing Picture:";
		echo $result_row['name'];
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
	<table style="width:100%">
		<tr>
			<td style="width:20%"> User </td>
			<td style="width:80%"> Comment </td>
		</tr>          
<?php
	}
	$getComments = "SELECT * FROM Comment WHERE media_fk = '$media_id'";
	$commentResult = mysql_query($getComments);
	
	while ($row = mysql_fetch_row($commentResult)) {
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
<p> Send A Message </p>
<table>
	<tr>
		<td>
			<form method="post" action="comment.php">
				<span>Message: </span><input type="text" name="message" required>
				<input type="submit" value="Send"></button>
			</form>
		</td>
	</tr>
</table>
</body>
</html>
