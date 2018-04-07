<?php
include "mysqlClass.inc.php";


function user_exist_check ($username, $password){
	$query = "select * from account where username='$username'";
	$result = mysql_query( $query );
	if (!$result){
		die ("user_exist_check() failed. Could not query the database: <br />". mysql_error());
	}	
	else {
		$row = mysql_fetch_assoc($result);
		if($row == 0){
			$query = "insert into account values ('$username','$password')";
			echo "insert query:" . $query;
			$insert = mysql_query( $query );
			if($insert)
				return 1;
			else
				die ("Could not insert into the database: <br />". mysql_error());		
		}
		else{
			return 2;
		}
	}
}


function user_pass_check($username, $password)
{
	
	$query = "select * from account where username='$username'";
	echo  $query;
	$result = mysql_query( $query );
		
	if (!$result)
	{
	   die ("user_pass_check() failed. Could not query the database: <br />". mysql_error());
	}
	else{
		$row = mysql_fetch_row($result);
		if(strcmp($row[1],$password))
			return 2; //wrong password
		else 
			return 0; //Checked.
	}	
}

function updateMediaTime($mediaid)
{
	$query = "	update  media set lastaccesstime=NOW()
   						WHERE '$mediaid' = mediaid
					";
					 // Run the query created above on the database through the connection
    $result = mysql_query( $query );
	if (!$result)
	{
	   die ("updateMediaTime() failed. Could not query the database: <br />". mysql_error());
	}
}

function upload_error($result)
{
	//view erorr description in http://us2.php.net/manual/en/features.file-upload.errors.php
	switch ($result){
	case 1:
		return "UPLOAD_ERR_INI_SIZE";
	case 2:
		return "UPLOAD_ERR_FORM_SIZE";
	case 3:
		return "UPLOAD_ERR_PARTIAL";
	case 4:
		return "UPLOAD_ERR_NO_FILE";
	case 5:
		return "File has already been uploaded";
	case 6:
		return  "Failed to move file from temporary directory";
	case 7:
		return  "Upload file failed";
	}
}

function connect()
{
	$serverName = "mysql1.cs.clemson.edu";
	$serverUsername = "MeTube_pvs0";
	$serverPassword = "Zb8^b~Z\\";
	$databaseName = "MeTube_ypnq";
	$username = $_POST['user_name'];
	$password = $_POST['pass_word'];
	$conn = mysqli_connect($serverName, $serverUsername, $serverPassword, $databaseName) or die("Connection failed:(" . mysql_error($conn));
	$sql = "SELECT pass_hash FROM User WHERE username = '" . $username . "'";
	$queryResult = $conn->query($sql);
	if ($queryResult->num_rows > 0) {
	while ($row = $queryResult->fetch_assoc()) {
		$hash = $row["pass_hash"];
		$auth = password_verify($password, $hash);
		if ($auth) $result["result"] = TRUE;
	}
	} else {
		$result["error"] = $queryResult;
	}
	return $conn;
}
	
?>
