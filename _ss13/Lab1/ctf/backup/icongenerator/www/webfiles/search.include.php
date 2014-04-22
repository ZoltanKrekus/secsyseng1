<?php

	echo "<h2>Search Icons</h2>";

	if(empty($_POST["submitbutton1"]))
	{
		echo '	<form action="main.php?i=search;do" method="post">
				In order to find your icon, we need the following data:<br />
				ID or part of the title: <input name="titel" type="text" size="35" maxlength="35" /><br />
				<input name="submitbutton1" type="submit" size="50" /><br />
			</form>';
	}
	else
	{
		echo "<h3>found icons (max. 20)</h3>";
		list_icons("search", $_POST["titel"]);
	}



?>

