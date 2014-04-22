<?php

	require_once "functions.inc.php";
	require_once "config.inc.php";

	include "/home/website/www/webfiles/header.php";

	do_subsite();
	db_connect();

	require_once $props["page"];

	echo '	<br />
		<br />
		<a href="main.php" target="_self"><img src="./static/home.png" border="0" alt="home" /> goto main page</a>
		<hr />
		<em>icongenerator service</em>';

	include "/home/website/www/webfiles/footer.html";
?>
