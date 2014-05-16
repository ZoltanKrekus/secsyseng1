<?php 
$error = "";
session_start();

if(isset($_POST["pw"])) {
	if($_POST["pw"] == "password") {
		$_SESSION["admin"] = 1;
	} else {
		echo "<div style='color:red;'>Falsches Passwort!</div>";
	}
}

if(isset($_SESSION["admin"]) && $_SESSION["admin"] == 1) {
	echo "<div style='color:green;'>Sie sind als Admin eingeloggt!</div>";
	return;
}
?>


<p>Geben Sie das Passwort f&uuml;r den Adminbereich ein:<br/>
<form action="login.php" method="post">
<input type="text" name="pw"/><br/>
<input type="submit" value="Login">
