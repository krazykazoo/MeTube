<!DOCTYPE html> 

	<?php
		include_once 'header.php';
		include_once 'function.php';
	?>	
	
	<div id='upload_result'>
		<?php 
			if(isset($_REQUEST['result']) && $_REQUEST['result']!=0) {		
				echo upload_error($_REQUEST['result']);
			}
		?>
	</div>
	<br/><br/>
	<?php
		$search = $_POST['search'];
		$query = "SELECT * from Media WHERE title LIKE %$search%"; 
		$result = mysql_query( $query );
		if (!$result) {
		   die ("Could not query the media table in the database: <br />". mysql_error());
		}
	?>
	    
    <div style="background:#339900;color:#FFFFFF; width:150px;">Uploaded Media</div>
	<table width="50%" cellpadding="0" cellspacing="0">
		<?php
			while ($result_row = mysql_fetch_assoc($result)) //filename, username, type, mediaid, path
			{ 
				$mediaid = $result_row['media_id'];
				$filename = $result_row['name'];
				$filenpath = $result_row['path'];
				$user = $result_row['username']
		?>
        <tr valign="top">			
			<td>
				<?php 
					echo $user;  //mediaid
				?>
			</td>
            <td>
            	<a href="media.php?id=<?php echo $mediaid;?>" target="_blank"><?php echo $filename;?></a> 
           	</td>
           	<td>
           		<a href="<?php echo $filenpath;?>" target="_blank" onclick="javascript:saveDownload(<?php echo $result_row[4];?>);">Download</a>
			</td>
		</tr>
        <?php
			}
		?>
	</table>
	


</html>