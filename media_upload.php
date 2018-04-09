<?php
include_once 'header.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Media Upload</title>
</head>

<body>

<form method="post" action="media_upload_process.php" enctype="multipart/form-data" >
    <table width="100%">
        <tr>
            <td>
                <input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
                <span>Add a Media: <em> (Each file limit 10M)</em> </span>
            </td>
            <td>
                <input  name="file" type="file" size="50" required>
            </td>
  		</tr>
  		<tr>
			<td width="20%">Title:</td>
			<td width="80%"><input type="text" name="title" required><br /></td>
  		</tr>
		<tr>
			<td  width="20%">Tags:</td>
			<td width="80%"><input type="text" name="tags" required><br /></td>
		</tr>
		<tr>
			<td  width="20%">Category:</td>
			<td>
			    <select name="category" required>
                    <option value="entertainment">Entertainment</option>
                    <option value="kids">For Children</option>
                    <option value="educational">Educational</option>
                    <option value="other">Other</option>
                </select>
            </td>
		</tr>
		<tr>
		    <td  width="20%">Description:</td>
		    <td>
		        <input type="textarea" name="descrition" required>
		    </td>
		</tr>
		<tr>
	        <td>
	            <input value="Upload" name="submit" type="submit">
	        </td>
 		</tr>
	</table>             
 </form>

</body>
</html>
