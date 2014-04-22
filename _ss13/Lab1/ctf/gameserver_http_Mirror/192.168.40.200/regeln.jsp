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

        <h1>CTF-Regeln</h1>

Auf dieser Seite finden Sie die Regeln, die Sie w&auml;hrend des CTF-Contests beachten m&uuml;ssen. Sehen Sie sich auch die <a href="punkte.jsp">Informationen zu den Punkten</a> an. Dort steht auch mehr zu den Flags, die Sie sammeln k&ouml;nnen.

<h2>Allgemeines</h2>

<p>Dieser CTF-Contest wird im Rahmen der Lehrveranstaltungen <em>Security for Systems Engineering</em> und <em>IT Security in Large IT Infrastructures</em> abgehalten. Dadurch ist es erforderlich, dass neben der Verteidigung des eigenen Rechners und dem Angriff der Rechner anderer Gruppen auch ein Protokoll verfasst wird.
</p>

<p>Die virtuellen Images werden von uns zur Verf&uuml;gung gestellt. Auf den Hosts, welche diese virtuellen Images hosten, und auf den Images selbst wird es keinen Internetzugang geben.
</p>

<p>Falls Sie Hinweise, Kritik oder W&uuml;nsche in Bezug auf den CTF-Contest haben, teilen Sie uns diese bitte per e-mail an <a class="linkification-ext" href="mailto:lva.security@inso.tuwien.ac.at" title="Linkification: mailto:lva.security@inso.tuwien.ac.at">lva.security@inso.tuwien.ac.at</a> mit. Besten Dank!
</p>

<p>Die Regeln f&uuml;r diesen CTF-Contest sind zum Teil aus Regeln anderer CTF-Contests angepasst. Dazu geh&ouml;ren die Regeln des  da.open(2005), <img class="extern" src="style/extern.png" title="(external link)" alt="(external link)"/><a href="http://ictf.cs.ucsb.edu/archive/iCTF_2007/index.html">UCSB International Capture The Flag</a>, <img class="extern" src="style/extern.png" title="(external link)" alt="(external link)"/><a href="http://conference.hackinthebox.org/hitbsecconf2005kl/?p=35">Hack In The Box Conference 2005 CTF</a>.
</p>

<h2>Beurteilung</h2>

<p>Die Notengebung f&uuml;r die Lehrveranstaltungen basiert auf dem Gruppenprotokoll, das Sie erstellen m&uuml;ssen. Achten Sie daher darauf, dass dieses detailiert ist. Eine <a href="protokoll_vorlage.txt">Vorlage</a> f&uuml;r das Protokoll ist vorhanden.
</p>

<h2>Protokoll</h2>

<p>Das Protokoll muss am selben Tag abgegeben werden, an dem auch der CTF-Contest stattfindet. Nach dem Ende des CTF-Contests bleibt Ihnen noch Zeit, um das Protokoll fertigzustellen und im PDF Format in tuwel abzugeben.
</p>

<p>Im Protokoll sollen Wege der Verteidigung und der Angriffe zusammen mit einigen technischen Hintergr&uuml;nden beschrieben sein. Der Umfang des Protokolls muss etwa 3.5-4 Seiten sein. Nehmen Sie auch Informationen &uuml;ber Angriffe auf, wenn Sie nicht funktioniert haben, f&uuml;r Sie aber vielversprechend ausgesehen haben. Sollten Sie <a href="advisories-info.jsp">Advisories</a> geschrieben haben, bitte nehmen Sie diese auch in das Abgabeprotokoll mit auf.
</p>

<h2>Grunds&auml;tzliche Hinweise</h2>

<ul>
    <li> Den Anweisungen der TutorInnen und VU-Mitarbeitern ist Folge zu leisten.</li>
    <li> Regelverst&ouml;&szlig;e k&ouml;nnen Punkteabz&uuml;ge bringen. Diese Punkteabz&uuml;ge k&ouml;nnen sofort erfolgen oder nach einer Analyse der Angriffe nach dem Ende des CTF-Contests. Dazu wird der gesamte Traffic zentral mitprotokolliert.</li>
    <li> Die Gruppen d&uuml;rfen nicht miteinander kommunizieren. Die Gruppengr&ouml;&szlig;e betr&auml;gt zwischen 3-5 Personen und es d&uuml;rfen keine externen Personen kontaktiert werden.</li>
    <li> Falls Sie denken, dass eine Gruppe unfair handelt, teilen Sie es uns bitte mit.</li>
</ul>

<p>Die nachfolgenden Regeln sind nicht vollst&auml;ndig. Sie zeigen vielmehr eine Richtung auf, in die gearbeitet werden soll. Der Sinn dieser praktischen &Uuml;bung ist es, dass gelernt werden kann, wie man Systeme richtig und effektiv absichert. Denken Sie bei Ihren Handlungen an die Fairness und daran, dass es allen TeilnehmerInnen auch eine Freude bereiten soll an dem CTF-Contest teilzunehmen.
</p>

<h2>Angriff</h2>

<ul>
    <li> Es d&uuml;rfen nur die Rechner mit den Images angegriffen werden, welche von uns ausgegeben werden. Angriffe au&szlig;erhalb der &Uuml;bungsumgebung oder Angriffe auf Rechner von TeilnehmerInnen sind untersagt. Dies inkludiert nat&uuml;rlich auch Angriffe auf z.B. den Gameserver.</li>
    <li> Nach einem erfolgreichen Angriff muss das gefundene Flag auf dem Gameserver eingetragen werden. Erst dann wird ein Angriff als erfolgreich gewertet und das angreifende Team erh&auml;lt Punkte.</li>
    <li> DoS Angriffe durch Flooden etc. sind verboten.</li>
    <li> Das L&ouml;schen und &auml;ndern von Flags wird als unfair angesehen und f&uuml;hrt zu Punkteabzug.</li>
    <li> Die gestohlenen Flags m&uuml;ssen gleich eingetragen werden, sie haben nur eine begrenzte G&uuml;ltigkeitsdauer. </li>
</ul>

<h3>M&ouml;gliche Status Meldungen beim Abgeben von Flags am Gameserver</h3>

<ul>
    <li>"Status:scored" Erfolgreicher Angriff.</li>
    <li>"Status:resubmission" Das Flag wurde bereits abgegeben.</li>
    <li>"Status:denied" Das eigene Service funktioniert nicht richtig, Abgabe abgelehnt.</li>
    <li>"Staus:expired" Flag ist abgelaufen.</li>
    <li>"Status:error" Fehlerhafte Eingabe. Die genaue Beschreibung wird ausgegeben.</li>
</ul>

<h2>Verteidigung</h2>

<ul>
    <li> Es ist nicht erlaubt Zugriffe an Hand der IP Adresse via Firewall zu beschr&auml;nken. Alle notwendigen Services m&uuml;ssen von allen teilnehmenden Rechnern erreichbar sein. Insbesondere ist damit auch gemeint, dass es verboten ist nur Zugriffe vom Gameserver zu erlauben und andere TeilnehmerInnen zu blockieren.</li>
    <li> Es ist nicht erlaubt Zugriffe auf Applikationsebene zu filtern und dadurch z.B. nur die Zugriffe des Gameservers zu erlauben.</li>
    <li> Es d&uuml;rfen keine Mechanismen aktiviert werden, um Buffer Overflows zu verhindern. Ihre Aufgabe ist es Schwachstellen zu erkennen und diese auszubessern.</li>
    <li> Es d&uuml;rfen bei Programmen keine auf der Website spezifizierten Funktionen deaktiviert werden, selbst wenn der Gameserver nicht alle Funktionen bei den Zugriffen verwendet.</li>
    <li> Zur Absicherung von Systemen d&uuml;rfen die Services neu kompiliert oder Scripts angepasst werden. Dabei ist jedoch zu beachten, dass die spezifierten Funktionalit&auml;ten erhalten bleiben.</li>
</ul>

<h2>Abschlie&szlig;ende Tipps</h2>

<ul>
    <li> Beachten Sie, dass Sie nach Ende des CTF-Contests ein Protokoll abgeben m&uuml;ssen.</li>
    <li> Denken Sie daran, dass Sie die Funktionalit&auml;ten der Services nicht zu sehr einschr&auml;nken, damit der Gameserver die Wertungen vornehmen kann, indem Flags deponiert und abgefragt werden.</li>
    <li> Planen Sie Ihr Vorgehen. Eventuell sollten Sie schon vorab vereinbaren wer f&uuml;r Angriffe/Verteidigung/Protokoll zust&auml;ndig ist.</li>
    <li> &Uuml;berlegen Sie sich, ob Sie Backups der Konfigurationen/Services anfertigen wollen.</li>
    <li> Seien Sie <em>fair</em>!</li>
</ul>


        </div>

        <div id="copy"><a href="mailto:esse@inso.tuwien.ac.at">ESSE</a> 2013</div>



    </body>
</html>
