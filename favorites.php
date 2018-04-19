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
		height: 65px;
		margin: 1px;
}

.buttonz:hover {
    background-color: #522D80;
}
</style>
</head>

<br/><br/>
<?php
	echo "Favorites";
	$getUserId = "SELECT * FROM Account WHERE username = '".$_SESSION['username']."'";
	$userResult = mysql_query($getUserId);
	$row = mysql_fetch_assoc($userResult);
	$userId = $row['account_id'];


	$query = "SELECT * FROM Favorites WHERE user_fk = '$userId'";
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
				$favoriteResult = mysql_query($query);
				while ($result_row = mysql_fetch_assoc($favoriteResult)) //filename, username, type, mediaid, path
				{
					$mediaid = $result_row['media_id'];
					$filename = $result_row['name'];
					$filenpath = $result_row['path'];
					$user = $result_row['username'];
					$title = $result_row['title'];
					$views = $result_row['views'];
					$type = $result_row['type'];

		?>
        	 <tr valign="top">
						 <td>
								 <?php
								 if(substr($type,0,5)=="image") //view image
								 {
									 echo "Viewing Picture: ";
									 echo $title;
									 echo "<br /><br />";
									 echo '<a href=media.php?id='.$mediaid.'>';
									 echo '<img src="'.$filenpath.'" width="320" height="240" />';
									 echo '</a>';
								 }
								 else //view movie
								 {
									 echo "Viewing Video: ";
									 echo $title;
									 echo "<br />";
									 echo '<a href=media.php?id='.$mediaid.'>';
									 echo '<video width="320" height="240">';
									 echo '<source src="'.$filenpath.'" type="video/mp4">';
									 echo '<source src="'.$filenpath.'" type="video/ogg">';
									 echo "Your browser does not support the video tag.";
									 echo '</video>';
									 echo '</a>';
								 }
							 ?>
							 <br />
						 </td>
            <td>
	            <a href="media.php?id=<?php echo $mediaid;?>"><button class="buttonz" type="button"><?php echo $title;?></button></a>
            </td>
            <td>
	            <a href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4];?>);"><button class="buttonz" type="button">Download</button></a>
            </td>
            <td>
   				<span><em>Views: <?php echo $views; ?> </em></span>
			</td>
			<td>
				<form method="post" action="dropFavorite.php">
					<input type="hidden" name="media_id" value="<?php echo $mediaid;?>">
					<input class="buttonz" type="submit" value="Remove">
				</form>
			</td>
		</tr>
        <?php
			}
		}
		?>
	</table>
   </div>
</body>
</html>
