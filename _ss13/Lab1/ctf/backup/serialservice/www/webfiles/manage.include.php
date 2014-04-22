<?php
echo "<h2>add a serial</h2>";

if(empty($_POST['title'])) {
        output_html_form();
} else {
        $etitle = sqlite_escape_string($_POST['title']);
        $ebemerkung = sqlite_escape_string($_POST['bemerkung']);
        $esecret = sqlite_escape_string($_POST['secret']);
        haskell_add($etitle,$ebemerkung,$esecret); 
        echo "stored";
}
function haskell_add($titel,$bemerkung,$secret) {
        $fp = fopen(LOCKFILE,'w');

        $shell_titel = escapeshellcmd($titel);
        $shell_bemerkung = escapeshellcmd($bemerkung);
        $shell_secret = escapeshellcmd($secret);

        flock($fp,LOCK_EX);
        $output = shell_exec("./scripths.sh store \"$shell_titel\" \"$shell_bemerkung\"  \"$shell_secret\"");
        flock($fp,LOCK_UN);
}

function output_html_form() {
        echo '
<form method=POST action="?i=manage">
<fieldset>
 <legend>data</legend>
 <label for="textinput1">name:</label><br>
 <input type="text" name="title" ><br>

 <label>Key: Attention! "Key" is needed to retrieve the serial, store it in a safe place</label><br>
 <input type="text" name="bemerkung" id="bemerkung"></label><br>

 <label>Serial</label><br>
 <input type="text" name="secret"></label><br>

 <button type="submit">add</button>
</fieldset>
</form>';
}

?>
