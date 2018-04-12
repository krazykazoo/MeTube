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

<body>
<div id="categories">
	<span> Browse by Category: </span><br />
	<a href="browse.php?category=entertainment"> Entertainment</a><br />
	<a href="browse.php?category=kids"> Kids</a><br />
	<a href="browse.php?category=educational"> Educational</a><br />
	<a href="browse.php?category=Other"> Other </a><br />
</div>

<p>Welcome <?php if (isset($_SESSION['username'])) echo $_SESSION['username'];?></p>
<?php if (isset($_SESSION['username'])) echo "<a href='media_upload.php'  style='color:#FF9900;'>Upload File</a>"; ?>
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

		?>
        	 <tr valign="top">			
			<td>
					<?php
						echo $user;  //mediaid
					?>
			</td>
                        <td>
            	            <a href="media.php?id=<?php echo $mediaid;?>"><?php echo $title;?></a> 
                        </td>
                        <td>
            	            <a href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4];?>);">Download</a>
                        </td>
		</tr>
        <?php
			}
		?>
	</table>
   </div>
</body>
</html>
