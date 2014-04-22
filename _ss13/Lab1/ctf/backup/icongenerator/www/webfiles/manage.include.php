<?php

	echo "<h2>manage icons</h2>";

	if($props["action"] == "upload")
	{
		if(empty($_POST["titel"]) OR strlen($_POST["titel"]) > 50)
		{
			print_error("invalid title!");
			$props["action"] = "new";
		}
		elseif(empty($_POST["app"]) OR strlen($_POST["app"]) > 50)
		{
			print_error("invalid appname!");
			$props["action"] = "new";
		}
		else
		{
			echo "<h3>create new icon</h3>";
			$data = insert_icon($_POST["titel"], $_POST["app"], $_POST["bemerkung"], $_POST["geheim"]);
			echo 'ID of your Icon: <font face="Courier"><!-- DO NOT modify the following line (needed by Gameserver)! -->'."\r\n"."<!-- ID= -->".htmlentities($data["id"])."\r\n".'</font><br />';

			if(!process_file_upload($data["id"]))
				print_error("Image was not uploaded / Icon could not be created!");
		}
	}

	if($props["action"] == "new")
	{
			echo "<h3>create new icon</h3>";
			echo '	<form action="main.php?i=manage;upload" method="post" enctype="multipart/form-data">
					title: <input name="titel" type="text" size="50" maxlength="50" /><br />
					appname: <input name="app" type="text" size="50" maxlength="50" /><br />
					description (will be kept secret): <input name="bemerkung" type="text" size="50" maxlength="50" /><br />
					codeword (needed in order to modify the icon again): <input name="geheim" type="text" size="30" maxlength="30" /><br />
					upload JPEG-Image: <input name="icon" type="file" size="50" maxlength="'.MAX_FILE_SIZE.'" accept="image/*"><br />
					Note: max filesize '.MAX_FILE_SIZE.' Bytes.<br />
					<input name="submitbutton" type="submit" size="50" /><br />
				</form>';
		
	}
	if($props["action"] == "edit")
	{
		echo "<h3>edit icon</h3>";
		if(empty($_POST["submitbutton1"]) AND empty($_POST["submitbutton2"]))
		{
			echo '	<form action="main.php?i=manage;edit" method="post" enctype="multipart/form-data">
					In order to edit your icon, we need the following data:<br />
					ID oder part of the title: <input name="titel" type="text" size="35" maxlength="35" /><br />
					codeword: <input name="geheim" type="text" size="30" maxlength="30" /><br />
					<input name="submitbutton1" type="submit" size="50" /><br />
				</form>';
		}
		elseif(empty($_POST["submitbutton2"]))
		{
			$data = edit_icon_search($_POST["titel"], $_POST["geheim"]);
			if($data !== FALSE)
			{
				echo '	<form action="main.php?i=manage;edit" method="post" enctype="multipart/form-data">
						ID: <input name="id" type="text" size="50" maxlength="50" readonly="readonly" value="'.htmlentities($data["id"]).'" /><br />
						codewort: <input name="geheim" type="text" size="30" maxlength="30" readonly="readonly" value="'.htmlentities($_POST["geheim"]).'" /><br />
						<br />
						title: <input name="titel" type="text" size="50" maxlength="50" value="'.htmlentities($data["title"]).'" /><br />
						appname: <input name="app" type="text" size="50" maxlength="50" value="'.htmlentities($data["app"]).'" /><br />
						description (will be kept secret): <input name="bemerkung" type="text" size="50" maxlength="50" value="'.htmlentities($data["notice"]).'" /><br />
						<input name="submitbutton2" type="submit" size="50" /><br />
					</form>';
			}
			else
				print_error("Icon not found unique or codeword incorrect!");
		}
		else
		{
			$data = edit_icon_save($_POST["id"], $_POST["titel"], $_POST["app"], $_POST["bemerkung"], $_POST["geheim"]);
			if(!$data)
				print_error("icon not modified!");
			else
				echo "ok, data saved.";
		}
	}



?>

