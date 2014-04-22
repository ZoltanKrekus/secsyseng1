<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    





<head>
    <title>ESSE CTF 2013</title>
    <meta content="text/html; charset=iso-8859-1" name="content-type">
    <meta content="Vienna University of Technology, Institute of Computer Aided Automation, Industrial Software, ESSE - Establishing Security" name="author">
    <meta content="ESSE, Establishing Security, Security, INSO, ESSE@INSO, TU Wien, Lehrveranstaltungen" name="keywords">

    <link href="style/style.css" type="text/css" rel="stylesheet">
</head>




    <body>

        
<div id="sidebar-right">
    <h1>Gameserver</h1>
         <ul>
            <li><a href="submitflag.jsp">Submit Flags</a><br></li>
            <li><a href="SubmitAdvisory.jsp">Submit Advisories</a><br></li>
            <li><a href="GenerateFlag.jsp">Generate a Flag</a><br></li>
            <li></li>
            <li><a href="Advisories.jsp">Advisories</a><br></li>
            <li><a href="TeamServicesStat.jsp">Service Status</a><br></li>
            <li><a href="Score.jsp">Scores</a><br></li>
            <li><a href="team_service.jsp">Services</a><br></li>
            <li><a href="cross.jsp">Cross Flags</a><br></li>
            <li></li>
            <li><a href="regeln.jsp">Regeln</a><br></li>
            <li><a href="punkte.jsp">Punkte</a><br></li>
            <li><a href="advisories-info.jsp">Advisories Info</a><br></li>
            <li><a href="protokoll_vorlage.txt">Vorlage Abgabeprotokoll</a><br></li>
            <li></li>
         </ul>
    <h1>Reports</h1>
         <ul>
            <li><a href="GenericView.jsp?pagename=Ausw2">Abgegebene Flags pro Team</a><br></li>
            <li><a href="GenericView.jsp?pagename=Ausw4">Abgegebene Flags pro Team/Stunde</a><br></li>
            <li><a href="GenericView.jsp?pagename=Ausw5">Gestohlene Flags pro Team</a><br></li>
            <li><a href="GenericView.jsp?pagename=Ausw6">Gestohlene Flags pro Team/Stunde</a><br></li>
            <li><a href="GenericView.jsp?pagename=Ausw8">Anzahl gestohlener Flags pro Team/Service</a><br></li>
            <li><a href="GenericView.jsp?pagename=Ausw9">Anzahl gestohlener Flags pro Team/Service in letzten 15 Minuten</a><br></li>
            <li></li>
            <li><a href="GenericView.jsp?pagename=Ausw7">Gesamtanzahl abgegebener Flags pro Service</a><br></li>
            <li><a href="GenericView.jsp?pagename=Ausw3">Gesamt abgegebene Flags pro 30 Minuten</a><br></li>
         </ul>
    <h1>Security for Systems Engineering</h1>
        <ul>
            <li><img class="extern" src="style/extern.png" title="(external link)" alt="(external link)"/><a href="https://tuwel.tuwien.ac.at/mod/assignment/view.php?id=145125">Abgabe</a></li>
        </ul>
    <h1>IT Security in Large IT Infrastructures</h1>
        <ul>
            <li><img class="extern" src="style/extern.png" title="(external link)" alt="(external link)"/><a href="https://tuwel.tuwien.ac.at/mod/assignment/view.php?id=145121">Abgabe</a></li>
        </ul>
    <h1>ESSE</h1>
    <ul>
        <li><a href="https://security.inso.tuwien.ac.at/">ESSE Website</a></li>
        <li><a href="http://www.defbra.at/">ESSE's CTF Team: Defragmented Brains</a></li>
    </ul>
</div>


<div id="logo">
<p><a href="index.jsp"><img src="style/esse-ctf-logo.png"></a></p>
</div>

<div id="navigation">
<p><a href="regeln.jsp">CTF-Regeln</a> <a href="submitflag.jsp">Submit Flag</a> <a href="protokoll_vorlage.txt">Vorlage Protokoll</a></p>
</div>


        <div id="content">


<h1>Punkte f&uuml;r den CTF-Contest</h1>

<p>
F&uuml;r den CTF-Contest k&ouml;nnen Sie auf unterschiedliche Arten Punkte sammeln. Diese Seite beschreibt im Detail wie Sie Punkte erhalten. Die ersten 3 Pl&auml;tze werden nach dem Ende des Bewerbs Preise erhalten.
</p>

<h2>Allgemeines</h2>

<p>
Sie erhalten Punkte sowohl f&uuml;r eine erfolgreiche Verteidigung Ihrer Services, als auch f&uuml;r erfolgreiche Angriffe auf Services anderer Teams. Auch f&uuml;r gute <a href="advisories-info.jsp">Advisories</a> erhalten Sie Zusatzpunkte, die manuell durch die CTF-Contest Leitung vergeben werden.
</p>

<p>
Bitte beachten Sie dabei immer die <a href="regeln.jsp">Regeln</a>. Sollten Sie nicht regelkonform am CTF-Contest teilnehmen, werden wir Ihnen Punkte, auch im Nachhinein, aberkennen.
</p>

<h2>Verteidigung</h2>
<p>
Sie erhalten Punkte, wenn Ihr Service als "OK" erkannt wird. Reduzierte Punkte erhalten Sie wenn das Service als Broken erkannt wird, was bedeutet, dass das Service erreichbar ist aber das Flag nicht erfolgreich abgefragt werden konnte. 
</p>
<p>
Sie k&ouml;nnen auch nur Angriffspunkte f&uuml;r ein Service sammeln wenn Ihr eigenes Service zum Zeitpunkt des Submit "OK" ist. <b>Hinweis:</b> Versuchen Sie immer zuerst Ihre eigenen Services zu h&auml;rten und diese Verf&uuml;gbar halten.
</p>

<h2>Angriffe</h2>
<p>
Sie greifen andere Services an, indem Sie Sicherheitsl&uuml;cken in den jeweiligen Services ausn&uuml;tzen und dadurch <em>Flags</em> finden, die Sie dann <a href="submitflag.jsp">submitten</a> m&uuml;ssen, um Punkte zu erhalten.
</p>

<p>
Flags sind Strings aus 32 Zeichen (z.B.: <b>02062011180450NLD3ZL8T6XW1QKSJUU</b>). Die ersten 14 Zeichen ist ein Java Date Format: "ddMMyyyyHHmmss"). Testweise erzeugte Flags haben TEST im String. (z.B.: <b>02062011180814TESTHY4970VUKCGZIF</b>)
</p>

<p>
Sie bekommen pro Service und Team f&uuml;r 4 Flags die volle Punkteanzahl. Danach werden die Punkte f&uuml;r Flags dieser Service-Team Kombination nur mehr zu 20% gez&auml;hlt. <b>Hinweis:</b> Sie sollten nun nicht mehr manuell arbeiten, sondern versuchen ein Script zu erstellen.
</p>

<h2>Advisories</h2>
F&uuml;r abgegebene Advisories bekommen Sie manuell Punkte von der &Uuml;bungsleitung abh&auml;ngig von der Qualit&auml;t des Advisories. Sie k&ouml;nnen zwischen 0 und 15 Punkte f&uuml;r ein Advisory erhalten. 

<p>
</p>



        </div>

        <div id="copy"><a href="mailto:esse@inso.tuwien.ac.at">ESSE</a> 2013</div>



    </body>
</html>
