<?php

	require_once "functions.db.inc.php";

	$props = array("page" => "", "action" => "");
	$db = FALSE;

	function print_error($msg = "")
	{
		echo '<font color="red">uuups, there was an error!</font><br />';
		echo htmlentities($msg);
	}

	function do_subsite()
	{
		global $props, $dbnode;

		if(empty($_GET["i"]))
			$i = "front;none";
		else
			$i = $_GET["i"];

		if(!stristr($i, ";"))
			$i .= ";none";

		$tmp = explode(";", $i);
		$page = "./".$tmp[0];

		if(file_exists($page) || (($page = $page.".include.php") && file_exists($page)))
		{
			$props["page"] = $page;
			$props["action"] = $tmp[1];
		}
		else
		{
			$props["page"] = "front.include.php";
			$props["action"] = "none";
		}
		
		if($dbnode == fileinode($props["page"]))
		{
			$props["page"] = "front.include.php";
			$props["action"] = "none";
		}
	}

	function hash_secret($id, $key)
	{
		return md5($id."--".$key);
	}



?>
