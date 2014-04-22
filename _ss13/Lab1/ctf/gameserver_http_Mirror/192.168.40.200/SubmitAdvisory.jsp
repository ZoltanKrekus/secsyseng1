




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
            <h1>Advisory</h1>

            

            <p>
            Bitte beachten Sie, dass Sie dieses Advisory selbst speichern m&uuml;ssen f&uuml;r Ihr Protokoll. Nach dem Absenden dieses Formulars k&ouml;nnen Sie &uuml;ber den Gameserver nicht mehr darauf zugreifen!
            </p>

            <form action="AdvisoryServlet" method="post">
                <div>
                    <label for="teamid">TeamID</label><br/>
                    <input type="text" id="teamid" name="teamid" />
                </div>
                <div>
                    <label for="titel">Titel</label>
                    <input type="text" id="titel" name="titel" />
                </div>
                <div>
                    <label  for="shortDescriptionText">&Uuml;berblick</label>
                    <TEXTAREA NAME="shortDescriptionText" ROWS="3" style="width:100%" id="shortDescriptionText"></TEXTAREA>
                </div>
                <div>
                    <label for="descriptionText">Beschreibung</label>
                    <TEXTAREA NAME="descriptionText" ROWS="10" style="width:100%" id="descriptionText"></TEXTAREA>
                </div>
                <div>
                    <label for="exploitText">Schwachstelle</label>
                    <TEXTAREA NAME="exploitText" ROWS="10" style="width:100%" id="exploitText"></TEXTAREA>
                </div>
                <div>
                    <label for="patchText">Behebung</label>
                    <TEXTAREA NAME="patchText" ROWS="10" style="width:100%" id="patchText"></TEXTAREA>
                </div>

                <input type="submit" value="SEND"/>
            </form>
             


            

        </div>

        <div id="copy"><a href="mailto:esse@inso.tuwien.ac.at">ESSE</a> 2013</div>


    </body>
</html>
