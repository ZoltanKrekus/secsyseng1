<?php

	require_once "functions.db.inc.php";
	require_once "functions.helpers.inc.php";

	$props = array("page" => "", "action" => "");
	$db = FALSE;

	function list_icons($mode = "new", $search = FALSE)
	{
		global $db;

		if($search !== FALSE) // search for icon
		{
			$q = sqlite_query($db, ("SELECT * FROM icons WHERE \"id\" = '".sqlite_escape_string($search)."' ORDER BY title LIMIT ".MAX_QUERY_ICONS_LIMIT.";"));
			if(sqlite_num_rows($q) == 0)
				$q = sqlite_query($db, ("SELECT * FROM icons WHERE \"title\" LIKE '%".sqlite_escape_string($search)."%' ORDER BY title LIMIT ".MAX_QUERY_ICONS_LIMIT.";"));
			if(sqlite_num_rows($q) == 0)
			{
				echo "no icons matching search criteria!";
				return;
			}
		}
		elseif($mode == "top") // top-icons
			$q = sqlite_query($db, ("SELECT * FROM icons ORDER BY votes DESC LIMIT ".MAX_QUERY_ICONS_LIMIT.";"));
		else // last icons
			$q = sqlite_query($db, ("SELECT * FROM icons ORDER BY uploaded DESC LIMIT ".MAX_QUERY_ICONS_LIMIT.";"));

		echo '<table border="1"/>';
		echo '<tr>';
		echo '	<th>icon-ID</th>';
		echo '	<th>title</th>';
		echo '	<th>appname</th>';
		echo '	<th>show Icon</th>';
		echo '	<th>upload date</th>';
		echo '	<th>average rating</th>';
		echo '</tr>';
		while($row = sqlite_fetch_array($q))
		{
			echo '<tr>';
			echo '	<td><font face="Courier">'.htmlentities($row["id"]).'</font></td>';
			echo '	<td>'.htmlentities($row["title"]).'</td>';
			echo '	<td>'.htmlentities($row["app"]).'</td>';
			echo '	<td><a href="getit.php?id='.htmlentities($row["id"]).'&g" target="_self"><img src="./static/go.png" border="0" alt="go" /> icon</a> / <a href="getit.php?id='.htmlentities($row["id"]).'&j" target="_self"><img src="./static/go.png" border="0" alt="go" /> image</a></td>';
			echo '	<td>'.date("Y-m-d H:i:s (T)", $row["uploaded"]).'</td>';
			echo '	<td>'.htmlentities($row["votes"]).'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}

	function insert_icon($title, $app, $notice, $key)
	{
		global $db;

		$time = time();
		$votes = rand(0, 500);
		$id = strrev(sprintf("%02d%06d%02d", rand(0, 99), time()%(24*60*60*5), rand(0, 99)));

		$q = sqlite_query($db, ("INSERT INTO icons VALUES (	'".sqlite_escape_string($id)."',
									'".sqlite_escape_string($title)."',
									'".sqlite_escape_string($app)."',
									'".sqlite_escape_string($notice)."',
									'".sqlite_escape_string(hash_secret($id, $key))."',
									'".sqlite_escape_string($time)."',
									'".sqlite_escape_string($votes)."'
									);"));

		return array("id" => $id);
	}

	function edit_icon_search($titel, $key)
	{
		global $db;

		$q = sqlite_query($db, ("SELECT * FROM icons WHERE \"id\" = '".sqlite_escape_string($titel)."';"));
		if(sqlite_num_rows($q) != 1)
			$q = sqlite_query($db, ("SELECT * FROM icons WHERE \"title\" LIKE '%".sqlite_escape_string($titel)."%'"));
		if(sqlite_num_rows($q) != 1)
			return false; // icon not found

		$row = sqlite_fetch_array($q);

		if($row["secret"] !== hash_secret($row["id"], $key))
			return false; // incorrect secret

		return $row;
	}

	function edit_icon_save($id, $title, $app, $notice, $key)
	{
		global $db;

		$q = sqlite_query($db, ("UPDATE icons SET 	\"title\" = '".sqlite_escape_string($title)."',
								\"app\" = '".sqlite_escape_string($app)."',
								\"notice\" = '".sqlite_escape_string($notice)."'
						WHERE \"id\" = '".sqlite_escape_string($id)."' 
						AND \"secret\" = '".sqlite_escape_string(hash_secret($id, $key))."';"));

		return sqlite_changes($db) === 1;
	}

	function process_file_upload($id)
	{
		if(empty($_FILES["icon"]))
		{
			echo "no File entered.<br />";
			return false;
		}

		$upload_errors = array(
			UPLOAD_ERR_OK        => "No errors.",
			UPLOAD_ERR_INI_SIZE    => "Larger than upload_max_filesize.",
			UPLOAD_ERR_FORM_SIZE    => "Larger than form MAX_FILE_SIZE.",
			UPLOAD_ERR_PARTIAL    => "Partial upload.",
			UPLOAD_ERR_NO_FILE        => "No file.",
			UPLOAD_ERR_NO_TMP_DIR    => "No temporary directory.",
			UPLOAD_ERR_CANT_WRITE    => "Can't write to disk.",
			UPLOAD_ERR_EXTENSION     => "File upload stopped by extension."
		);

		if($_FILES["icon"]["error"] != UPLOAD_ERR_OK)
		{
			echo $upload_errors[$_FILES["icon"]["error"]]."<br />";
			return false;
		}
		
		if(empty($_FILES["icon"]["tmp_name"]))
		{
			echo "Filename is empty.<br />";
			return false;
		}

		$tmpname = tempnam(TMP_DIRECTORY, "icg0");
		$tmpnamegif1 = tempnam(TMP_DIRECTORY, "icg1");
		$tmpnamegif2 = tempnam(TMP_DIRECTORY, "icg2");
		//echo "tmpname:".$tmpname;

		if(!move_uploaded_file($_FILES["icon"]["tmp_name"], $tmpname))
		{
			echo "Move of file did not work.<br />";
			return false;
		}

		if(mime_content_type($tmpname) != "image/jpeg")
		{
			echo "Wrong mimetype.<br />";
			@unlink($tmpname);
			return false;
		}

		if(filesize($tmpname) > MAX_FILE_SIZE)
		{
			echo "File too large.<br />";
			@unlink($tmpname);
			return false;
		}

		$cmd = 'file '.$tmpname." | grep \"JPEG image data\" 2>&1";
		$output = "";
		$return = -1;
		exec($cmd, $output, $return);

		if($return != 0)
		{
			echo "Invalid file type.<br />";
			@unlink($tmpname);
			return false;
		}

		$cmd = 'convert -resize 16x16 -format gif '.$tmpname.' '.$tmpnamegif1.'';
		$output = "";
		$return = -1;
		exec($cmd, $output, $return);

		if($return != 0)
		{
			echo "Could not create small image.<br />";
			@unlink($tmpname);
			@unlink($tmpnamegif1);
			return false;
		}

		$cmd = 'convert -negate '.$tmpnamegif1.' '.$tmpnamegif2.'';
		$output = "";
		$return = -1;
		exec($cmd, $output, $return);

		if($return != 0)
		{
			echo "Could not create negative image.<br />";
			@unlink($tmpname);
			@unlink($tmpnamegif1);
			@unlink($tmpnamegif2);
			return false;
		}

		$cmd = 'convert -delay 15 '.$tmpnamegif1.' '.$tmpnamegif2.' -loop 0 '.ICON_DIRECTORY.$id.'.gif';
		$output = "";
		$return = -1;
		exec($cmd, $output, $return);

		if($return != 0)
		{
			@unlink($tmpname);
			@unlink($tmpnamegif1);
			@unlink($tmpnamegif2);
			echo "Could not create icon.<br />";
			return false;
		}

		$cmd = 'convert -resize 32x32 '.$tmpname.' '.ICON_DIRECTORY.$id.'.jpg';
		$output = "";
		$return = -1;
		exec($cmd, $output, $return);

		if($return != 0)
//		if(!copy($tmpname, ICON_DIRECTORY.$id.".jpg"))
		{
			@unlink($tmpname);
			@unlink($tmpnamegif1);
			@unlink($tmpnamegif2);
			echo "Could not create small image.<br />";
			return false;
		}

		echo "Icon generated.<br />";
		
		@unlink($tmpname);
		@unlink($tmpnamegif1);
		@unlink($tmpnamegif2);

		return true;
	}

?>
