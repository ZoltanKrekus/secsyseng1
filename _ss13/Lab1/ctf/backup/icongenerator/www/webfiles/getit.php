<?php

	require_once "functions.inc.php";
	require_once "config.inc.php";

	if(empty($_GET["id"]))
		die("no ID entered!");

	$id = $_GET["id"];
	if(strlen($_GET["id"]) < 10)
		$id = str_repeat("0", 10 - strlen($_GET["id"]));

	if(isset($_GET["j"]))
		$name = ICON_DIRECTORY.$id.".jpg";
	else
		$name = ICON_DIRECTORY.$id.".gif";

	if(!preg_match('/^[0-9]{10}$/', $id))
		die("invalid input!");
	elseif(!file_exists($name))
		die("invalid ID ".htmlentities($id)."!");
	else
	{
		$fp = fopen($name, 'rb');

		if(isset($_GET["j"]))
			header("Content-Type: image/jpeg");
		else
			header("Content-Type: image/gif");

		header("Content-Length: ".filesize($name));

		fpassthru($fp);
		exit;
	}

?>
