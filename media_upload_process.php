<?php
include_once 'header.php';
include_once "function.php";

/******************************************************
*
* upload document from user
*
*******************************************************/

$username=$_SESSION['username'];


//Create Directory if doesn't exist
if(!file_exists('uploads/'))
	mkdir('uploads/', 0757);
$dirfile = 'uploads/'.$username.'/';
if(!file_exists($dirfile))
	mkdir($dirfile,0755);
	chmod( $dirfile,0755);
	if($_FILES["file"]["error"] > 0 )
	{ 	$result=$_FILES["file"]["error"];} //error from 1-4
	else
	{
		$upfile = $dirfile.urlencode($_FILES["file"]["name"]);
	  
	  if(file_exists($upfile))
	  {
	  	$result="5"; //The file has been uploaded.
	  }
	  else{
			if(is_uploaded_file($_FILES["file"]["tmp_name"]))
			{
				if(!move_uploaded_file($_FILES["file"]["tmp_name"],$upfile))
				{
					$result="6"; //Failed to move file from temporary directory
				}
				else /*Successfully upload file*/
				{
					//insert into media table
					$title = $_POST['title'];
					$description = $_POST['description'];
					$category = $_POST['category'];
					$insert = "INSERT INTO Media (name, username, type, path, title, description, category)".
							  "values ('". urlencode($_FILES["file"]["name"])."','$username','".$_FILES["file"]["type"]."', '$upfile', '$title', '$description', '$category')";
					$queryresult = mysql_query($insert)
						  or die("Insert into Media error in media_upload_process.php " .mysql_error());
					chmod($upfile, 0644);
					$idSQL = "SELECT media_id FROM Media WHERE path ='$upfile' AND description = '$description'";
					$queryresult = mysql_query($idSQL) 
						or die("Select media_id error in media_upload_process.php " .mysql_error());
					$row = mysql_fetch_assoc($queryresult);
					$mediaid = $row['media_id'];
					$tagArray = explode(',', $_POST['tags']);
					foreach ($tagArray as $value) {
						$value = trim($value);
						$addTag = "INSERT INTO Tags (media_fk, tag) VALUES ('$mediaid', '$value')";
						$queryresult = mysql_query($addTag)
							or die("Insert into Tags error in media_upload_process.php " .mysql_error());
					}
					$result="0";
				}
			}
			else  
			{
					$result="7"; //upload file failed
			}
		}
	}
	
	//You can process the error code of the $result here.
?>

<meta http-equiv="refresh" content="0;url=browse.php?result=<?php echo $result;?>">
