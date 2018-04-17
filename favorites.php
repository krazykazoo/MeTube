<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include_once 'header.php';
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media browse</title>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<script type="text/javascript" src="js/jquery-latest.pack.js"></script>
<script type="text/javascript">
function saveDownload(id)
{
	$.post("media_download_process.php",
	{
       id: id,
	},
	function(message) 
    { }
 	);
} 
</script>
</head>

<br/><br/>
<?php
	echo "Favorites";
	$getUserId = "SELECT * FROM Account WHERE username = '".$_SESSION['username']."'";
	$userResult = mysql_query($getUserId);
	$row = mysql_fetch_assoc($userResult);
	$userId = $row['account_id'];


	$query = "SELECT * FROM Favorites WHERE user_fk = '$userId'"
	$result = mysql_query( $query );
	if (!$result){
   		die ("Could not query the media table in the database: <br />". mysql_error());
	}
?>
    
    <div> <?php if (isset($_GET['category'])) {echo "Browse " . $_GET['category'] . " videos:";} else {echo "Uploaded Media";}?> </div>
	<table width="50%" cellpadding="0" cellspacing="0">
		<?php
			while ($row = mysql_fetch_assoc($result)) {
				$favorite = $row['media_fk'];
				$query = "SELECT * FROM Media WHERE media_id = '$favorite'";
				
				while ($result_row = mysql_fetch_assoc($result)) //filename, username, type, mediaid, path
				{ 
					$mediaid = $result_row['media_id'];
					$filename = $result_row['name'];
					$filenpath = $result_row['path'];
					$user = $result_row['username'];
					$title = $result_row['title'];
					$views = $result_row['views'];

		?>
        	 <tr valign="top">			
            <td>
	            <a href="media.php?id=<?php echo $mediaid;?>"><?php echo $title;?></a> 
            </td>
            <td>
	            <a href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4];?>);">Download</a>
            </td>
            <td>
   				<span><em>Views: <?php echo $views; ?> </em></span>
			</td>
		</tr>
        <?php
			}
		}
		?>
	</table>
   </div>
   <p> Remove from Favorites? </p>
<form method="post" action="dropFavorite.php">
	<input type="hidden" name="media_id" value="<?php echo $media_id;?>">
	<input type="submit" value="Remove">
</form>
</body>
</html>