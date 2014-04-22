<?php

	echo "<h2>show Icon lists</h2>";

	if($props["action"] == "new")
	{
		echo "<h3>these are the latest Icons</h3>";
		list_icons("new");
		echo '<a href="main.php?i=list;top" target="_self"><img src="./static/go.png" border="0" alt="go" /> list of Top-Icons</a>';
	}

	if($props["action"] == "top")
	{
		echo "<h3>these are the Top-Icons</h3>";
		list_icons("top");
		echo '<a href="main.php?i=list;new" target="_self"><img src="./static/go.png" border="0" alt="go" /> list of latest Icons</a>';
	}



?>

