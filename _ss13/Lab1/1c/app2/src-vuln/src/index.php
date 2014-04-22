<?php

	require("config.php");
	require("functions.php");
	
	$conn = mysql_connect(SQL_HOST, SQL_USER, SQL_PASS);
	mysql_select_db(SQL_DB);

	$user = new user($_GET["s"]);
	if(!$user->is_logged_in() && !empty($_POST["username"]) && !empty($_POST["password"]))
		$user->perform_login($_POST["username"], $_POST["password"]);
	if($user->is_logged_in() && !empty($_GET["logoff"]))
		$user->perform_logoff();
		

	if(!$user->is_logged_in())
	{
		echo '
			<form method="post" action="index.php">
				user <input type="text" name="username" /><br />
				passwd<input type="password" name="password" /><br />
				<input type="submit" value="login" />
			</form>
		';
	}
	else
	{
		$user->userinfo();
	}
	
	echo '<hr/>';
	echo '<a href="index.php">link to main page without session</a><br />';
	echo '<a href="?'.$user->ses().'">link to main page as user</a><br />';
	echo '<a href="?logoff=now&'.$user->ses().'">log out</a><br />';
	online_user_list();
	echo 'servertime: '.date("Y-m-d H:i:s (T)").'<!-- 
unixzeit='.time().'
	--><br />';

?>
