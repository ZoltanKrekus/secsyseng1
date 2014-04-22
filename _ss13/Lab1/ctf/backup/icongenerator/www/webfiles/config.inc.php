<?php

	error_reporting(E_ALL | E_STRICT);
	ini_set('display_errors', 1);

	define("DATABASE_FILE", "../db/dbfile");
	define("ICON_DIRECTORY", "../icons/");
	define("TMP_DIRECTORY", "../tmp/");

	define("MAX_FILE_SIZE", 100000);

	define("MAX_QUERY_ICONS_LIMIT", 20);

	$dbnode = fileinode(DATABASE_FILE);

?>
