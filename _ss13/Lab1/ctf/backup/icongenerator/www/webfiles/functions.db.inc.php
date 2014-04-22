<?php

	function db_connect()
	{
		global $db;
		if(file_exists(DATABASE_FILE))
		{
			if(!($db = sqlite_open(DATABASE_FILE, 0666, $sqliteerror)))
			    die($sqliteerror);
			sqlite_exec($db, 'PRAGMA synchronous=OFF');
		}
		else
		{
			if($db = sqlite_open(DATABASE_FILE, 0666, $sqliteerror))
			{ 
			    sqlite_query($db, 'CREATE TABLE icons ("id" int(16), "title" varchar(255), "app" varchar(255), "notice" varchar(255), "secret" varchar(32), uploaded int(10), votes int(10))');
			    sqlite_exec($db, 'PRAGMA synchronous=OFF');
			}
			else
			    die($sqliteerror);
		}
	}


?>
