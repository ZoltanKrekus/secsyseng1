<?php session_start(); ?>
<?php include "/home/website/www/webfiles/header.php"; ?>

<center>
<p>
<form action="login.php" method="post">
<h2>Login</h2>
  <p><span>Username:</span>
    <input name="username" type="text" />
    <br/>
    <br/>
    <span> Password:</span>
<input name="password" type="password" />
<br/>
<br/>
<input name="go" type="submit" value="send" />
<input name="reset" type="reset" value="clear" />

<br/><br/>
<a href="index.php">Mainpage</a>  

</p>  

<p>
    <?php 

  $username = $_POST['username'];
  $password = $_POST['password'];

  $id = "";
  $is_login = false;

  $_SESSION['username'] = $username;
  $_SESSION['password'] = $password;

try
{
        $dbh = new PDO('sqlite:../db/whatevernote.s3db');

  if($username != "")
  {
         $sth = $dbh->prepare("SELECT * FROM user WHERE username = :username AND password = :password");
         $sth->bindParam(':username', $username);
	 $sth->bindParam(':password', $password);
	 $sth->execute();
   
	$result = $sth->fetchColumn();

 if($result != "")
    {
      $is_login = true;
//      $sth = $dbh->prepare("SELECT id FROM user WHERE password = '$password' AND username = '$username'");
	$sth = $dbh->prepare("SELECT id FROM user WHERE password = :password AND username = :username");
	$sth->bindParam(':username', $username);
        $sth->bindParam(':password', $password);
  
          $sth->execute();
            $_SESSION['id'] = $sth->fetchColumn();
    }
    else
    {
      echo "Username or Password is wrong. <br>  Fill in again.";
    }
  }
  else
  {
    echo "Please fill in all fields!";
  }

}
catch (PDOException $e)
{
        print ($e->getMessage());
        return false;
}
?>
    </p>
  <p>
    <?php
 if($is_login)
 {
        echo " Login successfully! <br> next ...><br>";
        echo '<a href="add.php">Add note</a><br>';
        echo '<a href="check.php">Check note</a><br>';
    echo '<a href="index.php">Mainpage</a>';
 }
?>
  </p>


</form>



</p>
</center>
<?php include "/home/website/www/webfiles/footer.html"; ?>
