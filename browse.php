<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include_once 'header.php';
	include_once "function.php";
?>
<html xmlns="http://www.w3.org/1999/xhtml">
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

.buttony {
    background-color: #F66733; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    cursor: pointer;
		height: 50px;
		width: 300px;
		margin: 5px;
}

.buttony:hover {
    background-color: #522D80;
}


</style>
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

<body>
<div id="categories">
	<span> Browse by Category: </span><br />
	<a href="browse.php?category=entertainment"><button class="buttonz" type="button">Entertainment</button></a><br />
	<a href="browse.php?category=kids"><button class="buttonz" type="button">Kids</button></a><br />
	<a href="browse.php?category=educational"><button class="buttonz" type="button">Educational</button></a><br />
	<a href="browse.php?category=Other"><button class="buttonz" type="button">Other</button></a><br />
</div>

<p>Welcome <?php if (isset($_SESSION['username'])) echo $_SESSION['username'];?></p>
<?php if (isset($_SESSION['username'])) echo "<a href='media_upload.php'  style='color:#FF9900;'><button class='buttonz' type='button'>Upload File</button></a>"; ?>
<div id='upload_result'>
<?php
	if(isset($_REQUEST['result']) && $_REQUEST['result']!=0)
	{
		echo upload_error($_REQUEST['result']);
	}
?>
</div>
<br/><br/>
<?php
	if (isset($_GET['category'])) {
		if ($_GET['category'] === 'entertainment') {
			$query = "SELECT * FROM Media WHERE category = 'entertainment'";
		} else if ($_GET['category'] === 'kids') {
			$query = "SELECT * FROM Media WHERE category = 'kids'";
		} else if ($_GET['category'] === 'educational') {
			$query = "SELECT * FROM Media WHERE category = 'educational'";
		} else {
			$query = "SELECT * FROM Media WHERE category = 'other'";
		}
		$result = mysql_query( $query );
		if (!$result){
	   		die ("Could not query the media table in the database: <br />". mysql_error());
		}
	}
	else {
		$query = "SELECT * from Media";
		$result = mysql_query( $query );
		if (!$result){
	   		die ("Could not query the media table in the database: <br />". mysql_error());
		}
	}
?>

    <div> <?php if (isset($_GET['category'])) {echo "Browse " . $_GET['category'] . " videos:";} else {echo "Uploaded Media";}?> </div>
	<table width="50%" cellpadding="0" cellspacing="0">
		<?php
			while ($result_row = mysql_fetch_assoc($result)) //filename, username, type, mediaid, path
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
						echo $user;  //mediaid
						echo '&nbsp&nbsp&nbsp';
					?>
			</td>
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
	            <a href="media.php?id=<?php echo $mediaid;?>"><button class="buttony" type="button"><?php echo $title;?></button></a>
            </td>
            <td>
	            <a href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4];?>);"><button class="buttony" type="button">Download</button></a>
            </td>
            <td>
   				<span><em>Views: <?php echo $views; ?> </em></span>
			</td>
		</tr>
        <?php
			}
		?>
	</table>
   </div>
</body>
</html>
