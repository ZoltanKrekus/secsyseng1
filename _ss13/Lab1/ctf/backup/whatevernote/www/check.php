<?php session_start() ?>
<?php include "/home/website/www/webfiles/header.php"; ?>

<center>
<form action="check.php" method="post">
Check:
<br/><br/>
Username: <input type="text" name="username" size="15"><br>
<br/><br/>
Password: <input type="text" name="password" size="15">
<br/><br/>
<input name="go" type="submit" value="send" /></th></tr>        
<br/><br/>
<a href="index.php">Mainpage</a>
</form>




<?php
$username = $_POST['username'];
$password = $_POST['password'];
$id = $_SESSION['id'];

try
{
    $dbh = new PDO('sqlite:../db/whatevernote.s3db');

	// $stmt = $dbh->query("SELECT username FROM user WHERE username = '$username' AND password = '$password'");
	$stmt = $dbh->query("SELECT username FROM user WHERE username = :username AND password = :password");
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', $password);
	$result = $stmt->fetch();

	// $stmt = $dbh->query("SELECT note FROM user,whatevernote WHERE user.username = '$username' and user.id = whatevernote.username");
 	$stmt = $dbh->query("SELECT note FROM user,whatevernote WHERE user.username = :username and user.id = whatevernote.username");
	$stmt->bindParam(':username', $username);	

	if($result != 0)
	{
		foreach ($stmt as $row)
        	{
            		print "* ".$row['note'];
				    echo "<br>";
        	}
	}
	else
	{
		echo "Username or Password wrong";
	}
}
catch (PDOException $e)
{
    print ($e->getMessage());
    return false;
}

?>
</center>
<?php include "/home/website/www/webfiles/footer.html"; ?>
