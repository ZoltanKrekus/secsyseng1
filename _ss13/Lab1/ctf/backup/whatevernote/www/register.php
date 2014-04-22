<?php include "/home/website/www/webfiles/header.php"; ?>
<center>
<p>
Registration:</p>
<form action="register.php" method="post">

Username: <input name="username" type="text" />
<br/><br/>
Password: <input name="password" type="password" />
<br/><br/>
Password 2: <input name="password2" type="password" />
<br/><br/>
<input name="go" type="submit" value="send" />
<input name="reset" type="reset" value="clear" />

<br/><br/>
<a href="index.php">Mainpage</a>

</form>

<p>
  <?php

$username = $_POST['username'];
$password = $_POST['password'];
$password2 = $_POST['password2'];
try
{
        $dbh = new PDO('sqlite:../db/whatevernote.s3db');

        if($password == $password2)
{
        if($username != "" && $password != "" && $password2 != "")
        {

          $sth = $dbh->prepare("SELECT username FROM user WHERE username = '$username'");
        $sth->execute();

      $result = $sth->fetchColumn();

      if($result != $username)
      {
                $dbh->beginTransaction();
        $dbh->exec("insert into user (username, password) values ('$username', '$password')");
        $dbh->commit();

        print "<br>";
        print "<h3> You have successfully registered. </h3>";
        echo '<h3> <br> next...<a href="login.php">Login.</a></h3>';
      }
      else
      {
        print "<h3> This username is already taken! </h3>";
      }
    }
    else
    {
      print "<br>";
      print "<h3> Please fill in all fields! </h3>";
    }
  }
  else
  {
    print "<br>";
    print "<h3> Password does not match! </h3>";
  }
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
