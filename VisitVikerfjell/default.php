<?php
	include("php/db.php");
	include("php/meny.php");
?>
<!DOCTYPE html>
<html>

  <head>
    <!-- laget av: Ole, Kontrollert av Gabriel -->
    <meta name="author" content="GOTC ~ Gruppe 1"> <!--Forfatter -->
    <meta name="keywords" content="Vikerfjell, høyfjell, Hønefoss, vestre Ådal, Buskerud"> <!--søkeord -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8"> <!--Spesifiserer bokstav-kode type som er brukt -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--Sørger for responsivt design -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.1/dist/leaflet.css"> <!-- responsivt kart i footeren -->
	<script src="https://unpkg.com/leaflet@1.0.1/dist/leaflet.js"></script> <!-- responsivt kart i footeren -->
    <link rel="stylesheet" type="text/css" href="CSS/Stiler.css"><!--Linker til CSS-dokumentet -->
    <link rel="shortcut icon" href="Bilder/icon2.ico" type="favicon/ico" /> <!--Øverste ikon på hjemmesiden(fjell-logoen) -->
    <title>Visit Vikerfjell</title> <!--Logonavn på browser-tabben -->
  </head>
  <!--media="screen" spesifiserer at innholdet er optimalisert for skjerm -->
  <style media="screen"> </style>

  <body>
    <!-- laget av: Tobias, kontrollert av Christian -->
    <header>
      <!--bildene under er header-bildet og logen som ligger på det. -->
<!--
      <div id="logginn">
        <a href="php/logginn.php" class="button">LoggInn</a>
        <div id="box">
          <div class="container-1">
            <img class="soke" src="Bilder/sok.png">
            <input id="sok" type="sok" placeholder="søk..." required> <!--Søkebar -->
        <!--  </div>
        </div>
      </div> -->


      <img class="bilde-logo" src="bilder/logo.png" height="180px" width="180px">
      <div class="header-image" src="bilder/header.jpg" height="auto" width="auto">
      </div>

    </header>

<!--~~~~~~~~~~~~~~~~~NAVIGASJON~~~~~~~~~~~~~~~~~~~~~-->
<!-- laget av: Tobias, kontrollert av Christian -->
    <nav id="nav" role="navigation">
      <ul>
		<?php 
			lagmeny($db);
		?>
	  <!--
        <li><a href="html/index.html">Hjem</a></li>
        <li><a href="html/hyttetomter.html">Hyttetomter</a></li>
        <li><a href="html/servicetjenester.html">Servcetjenester</a></li>
        <li><a href="html/ski.html">Ski</a></li>
        <li><a href="html/aktiviteter.html">Aktiviteter</a></li>
        <li><a href="html/kontaktOss.html">Kontakt oss</a></li>
		-->
      </ul>
    </nav>
    <nav class="mobile">
      <button>Toggle</button>
        <div>
		<!--
          <a href="default.php">Hjem</a>
          <a href="html/hyttetomter.html">Hyttetomter</a>
          <a href="html/servicetjenester.html">Servcetjenester</a>
          <a href="html/ski.html">Ski</a>
          <a href="html/aktiviteter.html">Aktiviteter</a>
          <a href="html/kontaktOss.html">Kontakt oss</a>
		  -->
        </div>
      </nav>


    <!--~~~~~~~~~~~~~~~~Innhold på siden~~~~~~~~~~~~~~~~~~ -->
    <!-- laget av: Gabriel og Christian (50%/50%), kontrollert av Tobias og Ole -->
    <div class="mainContent">
      <div class="content">
        <article class="topContent">

            <h2>Startside </h2>
            <p>Velkommen til Vikerfjell.</p>

        </article>

        <article class="bottomContent">
            <h2>Vikerfjell </h2>
            <p>Vikerfjell passer for hele familien!!</p>



        </article>
      </div>
    </div>

    <aside class="top-sidebar">
      <article>
        <h2> Aktuelt</h2>
        <p>Skiløypene er åpen!</p>
        <p></p>
      </article>
    </aside>
    <aside class="middle-sidebar">
      <article>
        <h2> Aktuelt</h2>
        <p>20% om du bestiller denne helgen</p>
        <p></p>
      </article>
    </aside>

    <script>
      $('button').click(function() {
      $(this).toggleClass('expanded').siblings('div').slideToggle();
      });
    </script>


<!-- laget av: Ole, Kontrollert av Gabriel og Christian -->
<!-- --------------------FOOTER--------------------->
  <footer>
    <div id="wrapper_foot">

    <!-- kart over Vikerfjell -->
		<div class="kart">
<div id="map" style="height: 200px; width: 250px;">Kart over Vikerfjell</div>
        <script>
            var map = L.map('map').setView([60.4858, 9.9297], 11);
            L.tileLayer('http://opencache.statkart.no/gatekeeper/gk/gk.open_gmaps?layers=norges_grunnkart&zoom={z}&x={x}&y={y}', {
                attribution: '<a href="http://www.kartverket.no/">Kartverket</a>'
            }).addTo(map);
        </script>
</div>


	<!-- utdatert kart, vi velger å gå for responsivt kart hentet fra kartverket med bruk av Leaflet.
    <!-- <div class="kart">
      <img src="bilder/kartvikerfjell.jpg"height="207" width="319">
    </div> -->

    <!-- Sosiale medier knapper med hyperlink til de forskjellige stedene (Snapchat mangler link til vikerfjell sin snapchat) -->
    <div class="sosmed">
      <p>Følg oss på sosiale medier</p>
    <ul>
      <a href="https://www.facebook.com/Tosseviksetra/">
        <img border="0" alt="sosial" src="bilder/fb.png" height="50" width="50" style="Background-color:#374049;">
      </a>

      <a href="http://www.snapchat.com/">
        <img border="0" alt="sosial" src="bilder/sc.png" alt="Smiley face" height="48" width="48">
      </a>

      <a href="https://www.instagram.com/explore/tags/Vikerfjell/">
        <img border="0" alt="sosial" src="bilder/ig.png" alt="Smiley face" height="52" width="52">
      </a>
    </ul>
    </div>


  <!--  Footer kontakt-informasjon -->
    <div class="kontakt1">
      <p class="toppen">Kontakt:</p>
      <p><b> E-post: <a href="post@vikerfjell.com" style=color:#66ccff; >post@vikerfjell.com</a></b></p>
      <p><b>Telefon: </b>930 11 567</p>
      <p><b>Adresse:</b> Elsrud Gård</p>
      <p>Vestre Ådal 922, 3516 Hønefoss</p>
    </div>
    </div>
  </footer>
  </body>
</html>
