<!DOCTYPE html>
<html>
    <head>
        <title>Drehbuch (fixed)</title>
        <link rel="stylesheet" type="text/css" href="dreh.css">
    </head>
    <body>

    	<h1>Drehleier 2014</h1>

        <?php	
        	mysql_connect("localhost","root","") or die("DB server gone");
			mysql_select_db("poebel") or die("DB schema gone");
        ?>

    	<form method="post">
    		<p>Name: <input type="text" name="username" /></p>
    		<p>Text: <input type="text" name="usertext" /></p>
    		<p>
    			<input type="submit" name="drehen" value="Drehen" />
				<input type="submit" name="reset" value="Zurückdrehen" />
			</p>
    	</form>


    	<?php
    		if(@$_REQUEST['drehen'] == "Drehen")
			{
				$username = mysql_real_escape_string(@$_REQUEST['username']);
				$usertext = mysql_real_escape_string(@$_REQUEST['usertext']);
				mysql_query("INSERT INTO kasten(user, comment) VALUES ('$username', '$usertext');") or die("INSERT failed");
			}

    		if(@$_REQUEST['reset'] == "Zurückdrehen")
			{
				mysql_query("TRUNCATE TABLE kasten;") or die("TRUNCATE failed");
			}

			$result=mysql_query("SELECT user, comment, time FROM kasten ORDER BY time DESC;") or die("SELECT failed");
		?>

		<table>

			<?php
				while($row=mysql_fetch_array($result))
				{
					$user = htmlentities($row['user']);
					$time = htmlentities($row['time']);
					$comment = htmlentities($row['comment']);
			?>
					<tr>
						<td><? echo "$user<br/>$time" ?></td>
						<td><? echo $comment ?></td>
					</tr>
			<?php
				}
			?>

		</table>

    </body>
</html>
