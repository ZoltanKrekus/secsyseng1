<?php session_start(); ?>
<?php include "/home/website/www/webfiles/header.php"; ?>

<center>
<p>

<?php

$id = $_SESSION['id'];
$title = $_POST['title'];
$note = $_POST['note'];

try 
{
	$dbh = new PDO('sqlite:../db/whatevernote.s3db');
    if($id != "")
    {
        echo "You are logged in as: ";
        echo $_SESSION['username'];
?>

<form action="add.php" method="post" name="key">
Title: <input name="title" type="text" />
<br/><br/>
Note: <input name="note" type="text" />
<br/><br/>

<input name="go" type="submit" value="send" />
<input name="reset" type="reset" value="clear" />
<br/><br/>

</form>

<?php
	echo "$title";
	if($title != "" && $note != "")
    {
      	$dbh->beginTransaction();
      	$dbh->exec("INSERT INTO whatevernote (username,title,note) values ('$id','$title','$note')");
      	$dbh->commit(); 
      
      	print "<br>";
      	print "Your note has been added.<br>";
    } 
  	else
  	{
    	echo "Please fill in the field!<br>";
  	}
}
else
{
  echo "There was an error. <br> Your are not logged in!";
}  
  echo '<a href="index.php">Mainpage</a><br>';
  echo '<a href="check.php">Check note.</a><br>';
}
catch (PDOException $e) 
{
	print ($e->getMessage());
	$dbh->rollBack();
	return false;
}
?>

</p>
</center>
<?php include "/home/website/www/webfiles/footer.html"; ?>
