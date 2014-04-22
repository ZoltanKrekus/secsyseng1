<?php

	echo "<h2>registered serials</h2>";
	echo "<h3>displays all registered serials</h3>";
	list_songs();


	function list_songs()
	{
		echo '<table border="1"/>';
		echo '<tr>';
		echo '	<th>User</th>';
                echo "  <th>KEY (hidden)</th>";
		echo '</tr>';
                $array = haskell_list();
                /* var_dump($array); */
                foreach($array as $entry)
		{
                        
                        $parts = explode(":",$entry);
                        if(count($parts) != 2) continue;
                        echo '<tr>';
			echo '	<td>'.htmlentities($parts[0]).'</td>';
			echo '	<td>'. str_repeat("?",strlen($parts[1]))  .'</td>';
			echo '</tr>';
		}
		echo '</table>';
	}

        function haskell_list() {
	        $fp = fopen(LOCKFILE,'w');

	        flock($fp,LOCK_EX);
                $output = shell_exec("./scripths.sh  list");
	        flock($fp,LOCK_UN);

                $ar = explode("\n",$output);
                return $ar;
        }
?>

