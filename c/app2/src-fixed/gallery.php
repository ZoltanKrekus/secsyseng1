<?php

session_start();


if(isset($_POST['logout']) && $_POST['logout']==1) {
	session_destroy();
	$_SESSION = array();
}


function buildText($id) {
	$text = file_get_contents("images/".$id.".txt");

	if(isset($_SESSION["admin"]) && $_SESSION["admin"]==1)
		buildAdminView($text, $id);
	else
		buildUserView($text);
}

function buildUserView($text) {
	echo "<p>".$text."</p>";
}

function buildAdminView($text, $id) {
	echo "<form action='modify.php' method='get'><textarea name='text'>"
	.$text."</textarea><br/><input type='text' name='id' value='".$id."' hidden><input type='submit'/></form>";
}
?>

<table border="1">

<tr>
<td>
<img src="images/ID-100576.jpg"/>
<?php buildText("100576"); ?>
</td>
<td>
<img src="images/ID-100644.jpg"/>
<?php buildText("100644"); ?>
</td>
<td>
<img src="images/ID-1001180.jpg"/>
<?php buildText("1001180"); ?>
</td>
</tr>

<tr>
<td>
<img src="images/ID-1002043.jpg"/>
<?php buildText("1002043"); ?>
</td>
<td>
<img src="images/ID-1003048.jpg"/>
<?php buildText("1003048"); ?>
</td>
<td>
<img src="images/ID-1007492.jpg"/>
<?php buildText("1007492"); ?>
</td>
</tr>

</table>
<?php
if(isset($_SESSION["admin"]) && $_SESSION["admin"]==1)
	echo "<br/><form action='gallery.php' method='post'><input hidden name='logout' value='1'/><input type='submit' value='Logout'/></form>";
?>

<br/><br/>
<span style="font-size:11px;">All images from <a href="http://www.freedigitalphotos.net" target="_blank">
www.freedigitalphotos.net</a></span>
