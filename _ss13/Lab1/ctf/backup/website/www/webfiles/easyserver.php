<?php include("header.php"); ?>
<h1>Easyserver</h1>

<p>
We developed a (not so) customizable web server for your convenience. This server is <em>totally</em> lightweight, you'll see. It supports nearly nothing but should be ultra fast. Feel free to put your website (i.e., one html file) in the webroot.
</p>

<p>
<i>This server only supports plain  html 1.1</i> but please feel free to contact us if you have any feature requests -- we will happily deny such requests!
</p>

<p>
<i>Beware of wild zombies</i>
</p>

<p>
The service is available at port <b>7331</b>.
<br />
<br />
Check out <a target="_top" href="http://<? echo $_SERVER['SERVER_ADDR'] ?>:7331/index.html">easyserver</a>
</p>

<? include("footer.html"); ?>

