<?php
	session_start();
	include ("../php/db.php");
	// Kontroll og sending av data til databasen for pålogging.
	if(isset($_POST['tilbake'])){
		header("location:../html/index.html");
	}
	if(isset($_POST['send'])) {
		// Brukernavn og passord blir hentet fra tekstfeltene.
		$bruker = mysqli_real_escape_string($db,$_POST['bruker']);
		$passord = mysqli_real_escape_string($db,$_POST['passord']);

		// Passordet saltes og krypteres.
        $salt = "IT2_2017";
        $hash1_sha1 = sha1($salt.$passord);

		// Queries blir sendt til databasen
		$lsql = "SELECT idbruker FROM bruker WHERE brukerNavn = '$bruker' and passord = '$hash1_sha1'";
		$ssql = mysqli_query($db,$lsql);
		$asql = "SELECT feilLogginnTeller, idbruker FROM bruker WHERE brukerNavn = '$bruker'";
		$sasql = mysqli_query($db,$asql);
		$dsql = "SELECT TIMESTAMPDIFF(MINUTE,feilLogginnSiste,NOW()) AS tid FROM bruker WHERE brukerNavn = '$bruker'";
		$dssql = mysqli_query($db,$dsql);

		// Svar kommer fra databasen og blir lagt i arrays
		@$brukerrad = mysqli_fetch_array($ssql,MYSQLI_ASSOC);
		@$brukerid = $brukerrad['idbruker'];
		@$tellerrad = mysqli_fetch_array($sasql,MYSQLI_ASSOC);
		@$antallFeil = $tellerrad['feilLogginnTeller'];
		@$feilbrukerID = $tellerrad['idbruker'];
		@$datorad = mysqli_fetch_array($dssql,MYSQLI_ASSOC);
		@$minutter = $datorad['tid'];

		/*
		@$rad = mysqli_fetch_array($ssql,MYSQLI_ASSOC);
		@$aktiv = $rad['active'];
		$antallFeil = $rad["feilLogginnTeller"];
		$sisteFeil = $rad["feilLogginnSiste"];
		$datotid = date('Y/m/d H:i:s');

		echo($antallFeil);
		*/

		// Kontroll av antall forsøkte pålogginger
		if(($antallFeil >= 5) and ($minutter < 15)) {
			// Bruker må vente 15 minutter for hver gang etter 5 forsøk.
			$visminutter = ($minutter*-1)+15;
			$fmessage = "Du har skrevet feil brukernavn for mange ganger og må vente $visminutter minutter før du kan prøve på nytt.";
			echo "<script type='text/javascript'>alert('$fmessage');</script>";
			unset($_POST['send']);

		} else {
			// Hvis det er en bruker med denne informasjonen blir man logget på.
			$antall = mysqli_num_rows($ssql);
			if($antall == 1) {
				$_SESSION['bruker'] = $bruker;
				$_SESSION['passord'] = $passord;
				$rlsql = "UPDATE bruker set feilLogginnTeller = 0 WHERE idbruker = '$feilbrukerID'";
				$rssql = mysqli_query($db,$rlsql);
				header("location:../php/admin.php");
			}  else {
				// Ved feil informasjon vil databasen oppdatere feilteller med +1 og ny tid for siste logginn.
				$message = "Feil brukernavn eller passord";
				echo "<script type='text/javascript'>alert('$message');</script>";

				$flsql = "UPDATE bruker set feilLogginnSiste = NOW(), feilLogginnTeller = (feilLogginnTeller + 1) WHERE idbruker = '$feilbrukerID'";
				mysqli_query($db,$flsql);
				unset($_POST['send']);

			}
		}
	}
?>
<!DOCTYPE html>
<html>

  <head>
    <!-- laget av: Ole, Kontrollert av Gabriel -->
    <meta name="author" content="GOTC ~ Gruppe 1"> <!--Forfatter -->
    <meta name="keywords" content="Vikerfjell, høyfjell, Hønefoss, vestre Ådal, Buskerud"> <!--søkeord -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8"> <!--Spesifiserer bokstav-kode type som er brukt -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--Sørger for responsivt design -->
    <link rel="stylesheet" type="text/css" href="../CSS/admin.css"><!--Linker til CSS-dokumentet -->
    <link rel="shortcut icon" href="Bilder/icon2.ico" type="favicon/ico" /> <!--Øverste ikon på hjemmesiden(fjell-logoen) -->
    <title>Visit Vikerfjell</title> <!--Logonavn på browser-tabben -->
  </head>
  <!--media="screen" spesifiserer at innholdet er optimalisert for skjerm -->
  <style media="screen"> </style>

  <body>
    <!-- laget av: Tobias, kontrollert av Christian -->
    <header>
      <!--bildene under er header-bildet og logen som ligger på det. -->

    </header>

<!--~~~~~~~~~~~~~~~~~NAVIGASJON~~~~~~~~~~~~~~~~~~~~~-->
<!-- laget av: Tobias, kontrollert av Christian -->


    <!--~~~~~~~~~~~~~~~~Innhold på siden~~~~~~~~~~~~~~~~~~ -->
    <!-- laget av: Gabriel og Christian (50%/50%), kontrollert av Tobias og Ole -->
    <div class="mainContent">
      <div class = "login-side">
			<div class = "form">
				<form action = "" method = "POST" id = "iform" class = "innlogging-form">
					<h1>Innlogging for administrator</h1>
					<input type = "text" name = "bruker" title = "Skriv inn brukernavn" autofocus placeholder = "Brukernavn"> <br>
					<input type = "password" name = "passord" title = "Skriv inn passord" placeholder = "Passord">	<br>
					<input type = "submit" name = "send" value = "Logg inn">
					<input type = "submit" name = "tilbake" value = "til forsiden">
					<button type="button" onClick = "bytteForm()">Glemt passord?</button>
				</form>
				<form id="gform" class = "glemt-form">
					<h1>Glemt passord</h1>
					<input type = "text" name = "epost" title = "Skriv inn epost" placeholder = "Epost" autofocus> <br>
					<input type = "submit" name = "sendEpost" value = Send>
					<button type="button" onClick = "bytteForm()">Tilbake</button>
				</form>
				<!-- script for å bytte form mellom logginn og glemt passord-->
				<script>
					function bytteForm() {
						var iform = document.getElementById('gform');
						var gform = document.getElementById('iform');
						if(gform.style.display=='none'){
							iform.style.display='none';
							gform.style.display='block';
						}else{
							gform.style.display='none';
							iform.style.display='block';
						}
					}
				</script>
			</div>
		</div>

    </div>




  </body>
</html>
