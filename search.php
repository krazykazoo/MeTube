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
		$query = "SELECT media_id from Media WHERE title LIKE '%$search%'"; 
		$titleSearch = mysql_query( $query );
		$query = "SELECT media_fk FROM Tags WHERE tag Like '%$search%'";
		$allids = array();
		while($row = mysql_fetch_assoc($titleSearch)){
   			array_push($allids, $row['media_id']);
		}
		$tagSearch = mysql_query($query);
		while($row = mysql_fetch_assoc($tagSearch)){
   			array_push($allids, $row['media_fk']);
		}
		$result = array();
		$query = "SELECT * FROM Media WHERE media_id IN ('0'";

		foreach ($allids as $id) {
			$query = $query . ", '$id' ";
		}
		$query = $query . ")";
		$result = mysql_query($query);
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
					$user = $result_row['username'];
					$title = $result_row['title'];
					$views = ['views'];
			?>
	        <tr valign="top">			
				<td>
					<?php 
						echo $user;  //mediaid
					?>
				</td>
	            <td>
	            	<a href="media.php?id=<?php echo $mediaid;?>" target="_blank"><?php echo $title;?></a> 
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
			?>
		</table>
	</div>
</html>