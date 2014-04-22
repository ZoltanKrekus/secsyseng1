<?php
echo "<h2>retrieve serials</h2>";

if(empty($_POST["title"]) || empty($_POST["bemerkung"]) ) {
        output_html_form();
} else {
        $etitel = sqlite_escape_string($_POST['title']);
        $ebemerkung = sqlite_escape_string($_POST['bemerkung']);

        $sec = haskell_get($etitel,$ebemerkung);
        if($sec != null) {
                echo "the serial : $sec";
        } else {
                echo "wrong key";
        }
}

function output_html_form() {
        echo '
<form method=POST action="?i=query">
<fieldset>
 <legend>data</legend>
 <label for="textinput1">Name:</label><br>
 <input type="text" name="title" ><br>

 <label>Key</label><br>
 <input type="text" name="bemerkung"></label><br>

 <button type="submit" name="query">query</button>
</fieldset>
</form>';
}

function haskell_get($titel,$bemerkung) {
        $fp = fopen(LOCKFILE,'w');

        $shell_titel = escapeshellcmd($titel);
        $shell_bemerkung = escapeshellcmd($bemerkung);

        flock($fp,LOCK_EX);
        $output = shell_exec("./scripths.sh retrieve \"$shell_titel\" \"$shell_bemerkung\" ");
        flock($fp,LOCK_UN);

        return $output;
}

?>

