<?php

	function error($line, $file, $sql, $hint)
	{
		echo '
		<hr />
			<strong>MySQL-Error</strong><br />
			Error on line '.$line.' in file '.$file.'<br />
			'.mysql_error().'<br />
			<pre>'.$sql.'</pre>
		<hr />
		';
	}
	
	function online_user_list()
	{
		$sql = 'SELECT * FROM users WHERE logintime != "0" AND logintime > "'.(time() - 60*60).'";';
		$result = mysql_query($sql) or error(__LINE__, __FILE__, $sql); // MySQL-standard-querie
		echo "online last hour:<br />\r\n";
		while($row = mysql_fetch_assoc($result))
			echo $row["username"]." (".floor((time() - $row["logintime"]) / 60)." minutes ago)<br />\r\n";
	}
	
	class user
	{
		private $data = FALSE;
		
		function user($sessionid)
		{
			if(empty($sessionid))
				return;
			
			$sql = 'SELECT * FROM users WHERE sessionid = "'.mysql_real_escape_string($sessionid).'";';
			$result = mysql_query($sql) or error(__LINE__, __FILE__, $sql); // MySQL-standard-querie
			if(mysql_num_rows($result) == 1)
				$this->data = mysql_fetch_assoc($result);
			else
				$this->data = FALSE;
		}
		
		function userinfo()
		{
			echo "<h1>you are: ".$this->data["username"]."</h1>";
		}
		
		function ses()
		{
			return 's='.$this->data["sessionid"];
		}
		
		function get_max_lastnr()
		{
			$sql = 'SELECT MAX(lastnr) AS last FROM users;';
			$result = mysql_query($sql) or error(__LINE__, __FILE__, $sql); // MySQL-standard-querie
			if(mysql_num_rows($result) <= 0)
				return 0;
			
			$row = mysql_fetch_assoc($result);
			return intval($row["last"]);
		}

		function perform_logoff()
		{
			if(!$this->is_logged_in())
			{
				echo "must log in first";
				return;
			}

			$sql = 'UPDATE users SET sessionid = "", logintime = "0"
				WHERE username = "'.mysql_real_escape_string($this->data["username"]).'";';
			$result = mysql_query($sql) or error(__LINE__, __FILE__, $sql); // MySQL-standard-querie
			
			$this->data = FALSE;
		}

		private function make_new_session()
		{
			if(!$this->is_logged_in())
			{
				echo "must log in first";
				return;
			}

			$time = time();
			$nr = $this->get_max_lastnr() + 1;
			$sessionid = md5($time."|".$this->data["username"]);
			
			$sql = 'UPDATE users SET sessionid = "'.$sessionid.'", logintime = "'.$time.'", lastnr = "'.$nr.'"
				WHERE username = "'.mysql_real_escape_string($this->data["username"]).'";';
			$result = mysql_query($sql) or error(__LINE__, __FILE__, $sql); // MySQL-standard-querie
			
			$sql = 'SELECT * FROM users WHERE username = "'.mysql_real_escape_string($this->data["username"]).'";';
			$result = mysql_query($sql) or error(__LINE__, __FILE__, $sql); // MySQL-standard-querie
			$this->data = mysql_fetch_assoc($result);
		}

		function perform_login($username, $password)
		{
			if($this->is_logged_in())
			{
				echo "must log out first";
				return;
			}
			
			$sql = 'SELECT * FROM users WHERE username = "'.mysql_real_escape_string($username).'";';
			$result = mysql_query($sql) or error(__LINE__, __FILE__, $sql); // MySQL-standard-querie
			if(mysql_num_rows($result) == 1)
			{
				$row = mysql_fetch_assoc($result);
				
				if(crypt($password, $row["password"]) == $row["password"])
				{
					echo "login ok!<br />";
					$this->data = $row;
					$this->make_new_session();
				}
				else
				{
					echo "wrong password<br />";
					$this->data = FALSE;
				}
			}
			else
			{
				echo "username does not exist<br />";
				$this->data = FALSE;
			}
		}
		
		function is_logged_in()
		{
			if($this->data === FALSE)
				return FALSE;
			return TRUE;
		}
	}
	
?>
