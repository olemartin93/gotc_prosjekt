<?php
	session_start();
	include("db.php");
	include("meny.php");
	  include("sessionTimeout.php");
  if(!$_SESSION['bruker']){
    header("location:logginn.php");
    die();
  }
  //Kommentar-test
?>
<!DOCTYPE html>
<html>


  <head>
    <!-- laget av: Ole, Kontrollert av Gabriel -->
    <meta name="author" content="GOTC ~ Gruppe 1"> <!--Forfatter -->
    <meta name="keywords" content="Vikerfjell, høyfjell, Hønefoss, vestre Ådal, Buskerud"> <!--søkeord -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8"> <!--Spesifiserer bokstav-kode type som er brukt -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"><!--Sørger for responsivt design -->
    <link rel="stylesheet" type="text/css" href="../CSS/backend.css"><!--Linker til CSS-dokumentet -->
    <link rel="shortcut icon" href="Bilder/icon2.ico" type="favicon/ico" /> <!--Øverste ikon på hjemmesiden(fjell-logoen) -->
    <title>Visit Vikerfjell</title> <!--Logonavn på browser-tabben -->
  </head>
  <!--media="screen" spesifiserer at innholdet er optimalisert for skjerm -->
  <style media="screen"> </style>


   <body>
    <!-- laget av: Tobias, kontrollert av Christian -->
    <header>
      <!--bildene under er header-bildet og logen som ligger på det. -->
      <div id="logginn">
        <a href="../php/loggut.php">Logg ut</a>
        <a href="../php/admin.php">Bruker: <?php echo($_SESSION['bruker']); ?></a>
        <div id="box">

        </div>
		<nav id="nav" role="navigation">
			<ul>
				<li><a href="adminmeny.php">rediger meny</a></li>
				<li><a href="admin.php">rediger sider</a></li>
				<li><a href="adminbruker.php">rediger brukere</a></li>
			</ul>
		</nav>
      </div>
    </header>
<div class="aside-div">
	<aside>
	<ul>
	<li><h1>Sider</h1></li>
<?php 
	adminRediger($db);	
?>
	</ul>
	</aside>
</div>
      
    <div class="mainContent">
	<div class="wrapper_main">

	<button type="submit" form="form1" value="Submit">Lag nytt innlegg</button>
	<button type="submit" form="form1" value="Submit">Preview</button>

  </div>
<?php
	if (@!$_POST['knappenavn']){
	  } else{
	
	@$knappemann = $_POST['knappenavn'];
	$stmt = $db->prepare("SELECT * FROM innhold WHERE idmeny=$knappemann");
		mysqli_set_charset($db, "UTF8");
		$stmt->execute();
		$result = $stmt->get_result();
		$sub_id = '';
		while($row = $result->fetch_assoc()){
			$tittel = $row['tittel'];
			$id = $row['idinnhold'];
			$brødtekst = $row['text'];
	
	echo("<form action='' method='POST'>");
      echo("<fieldset>");
        echo("<legend>skriv her</legend>");
        echo("<p>");
        echo("<label>Tittel</label>");
		echo("</p>");
        echo("<input name='textoverskrift' type = 'text'
			id = 'txtOverskrift'
            value = '".$tittel."'/>");
        echo("<p>");
        echo("<label>Bilde</label>");
		echo("</p>");
		echo("<p>");		 
        echo("<input type = 'text'
            id = 'txtBilde'
            value = '' />");
        echo("</p>");
        echo("<p>");
        echo("<label>Brødtekst</label>");
		echo("</p>");
        echo("<textarea name='textbrødtekst'
			id = 'txtBrødtekst'
            rows = '3'
            cols = '80'>".$brødtekst."</textarea>");
		echo("<button name='knapplagre' type='submit' value=".$id.">Lagre</button>");
		echo("<button name='knappslette' type='submit' value=".$id.">Slett</button>");
      echo("</fieldset>");
 
    echo("</form>");		
	}
 } 
       if(isset($_POST['knapplagre'])) {
		$teksten = mysqli_real_escape_string($db,$_POST['textbrødtekst']);
    $tittel = mysqli_real_escape_string($db,$_POST['textoverskrift']);
		$id = $_POST['knapplagre'];
		
		$rsql = "UPDATE vikerfjell.innhold SET text ='$teksten', tittel='$tittel' WHERE idinnhold = '$id'";
		$srsql = mysqli_query($db,$rsql);
		unset($_POST['knapplagre']);
	}
  	if(isset($_POST['knappslette'])) {
		$id = $_POST['knappslette'];
		
		$ssql = "DELETE FROM `vikerfjell`.`innhold` WHERE `idinnhold`='$id'";
		$sssql = mysqli_query($db,$ssql);
		unset($_POST['knappslette']);
	}

//function lagretext() {
//		$stmt = $db->prepare("UPDATE vikerfjell.innhold
//                          SET text ='".$_POST['textbrødtext']."', tittel = '".$_POST['texttittel']."' 
//                          WHERE idinnhold=".$_POST['knapplagre'].";");
//		mysqli_set_charset($db, "UTF8");
//		$stmt->execute();	
	//	}


?>
</div>
</body>
</html>