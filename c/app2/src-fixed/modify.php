<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();
if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) {
        echo "<div style='color:red;'>Keine Berechtigung!</div>";
}
else {
	if(isset($_GET["text"]) && isset($_GET["id"])) {
		file_put_contents("images/".$_GET["id"].".txt", $_GET["text"]);
		echo "Der Text wurde erfolgreich ge&auml;ndert.";
	} else {
		echo "Bitte geben Sie Id und Text an.";
	}
}

echo "<br/><a href='gallery.php'>Zur&uuml;ck</a>";
?>
