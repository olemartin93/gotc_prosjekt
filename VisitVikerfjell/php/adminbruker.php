<?php
	session_start();
	include("db.php");
	include("meny.php");
	include("redigermeny.php");
	if(!$_SESSION['bruker']) {
		header('location:logginn.php');
		die();
	}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../CSS/adminmeny.css">
		<link rel="stylesheet" type="text/css" href="../CSS/adminCSS.css">
	</head>

	<body>	
		<header>
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
					<?php
						//lagmeny($db);
					?>
				</ul>
			</nav>
		</header>
	<div class="aside-div">
		<aside>
			<ul>
				
			</ul>
		</aside>
	</div>
		<div class="content">
			<h1> Velkommen, <?php echo($_SESSION['bruker']); ?></h1>

      <span><a href="adminbruker.php?ny">Legg til ny bruker </a></span >
      <span><a href="adminbruker.php?nypw">Endre passord</a></span>

      <?php
        $bruker = $_SESSION['bruker'];
        $passord = $_SESSION['passord'];

        $lagny = false;
        $nypwrd = false;

        if (isset($_GET['ny'])) {$lagny = true;}
        if (isset($_GET['nypw'])) {$nypwrd = true;}
        if (!($db = new vikerfjell())) {
          die("Ingen forbindelse til databasen");
        }
        if (isset($_POST['lagny']) &&
          $_POST['lagny']=='Registrer ny bruker') {
          //  Skal legge inn ny bruker
          $pass = $_POST['nyttpw'];
          $salt = "IT2_2017";
          $hash1_sha1 = sha1($salt.$pass);
          // salting av passord med sha1
    		  $nybruker = $_POST['nybruker'];
    		  $epost = $_POST['nyePost'];

    		  $lsql = "INSERT INTO bruker (brukerNavn, passord, ePost, feilLogginnTeller) VALUES ('$nybruker', '$hash1_sha1', '$epost', 0)";
    		  $ssql = mysqli_query($db,$lsql);
          // legger inn i databasen
        }
        if (isset($_POST['nypwrd']) &&
          $_POST['nypwrd']=='bytt Passord') {


            $passordG = mysqli_real_escape_string($db, $_POST['gammeltpw']);
            $passord1 = mysqli_real_escape_string($db, $_POST['nyttPassord']);
            $passord2 = mysqli_real_escape_string($db, $_POST['bekreftPassord']);
            $salt = "IT2_2017";
            $hash1_sha1 = sha1($salt.$passord2);

            if($passord == $passordG){
              // vis det gamle passordet stemmer
              if($passord1 == $passord2){
                $pwsql = "UPDATE bruker SET passord='$hash1_sha1' WHERE brukerNavn='$bruker'";
                $ssql = mysqli_query($db,$pwsql);
                // vis begge nye passord er lik, får bruker endre passord
              }
              else{
                echo"det nye passordet matcher ikke";
                echo"<script>window.location.href ='admin.php?nypw';</script>";
                die();

              }
            }
            else{
              echo"gammlet passord stemmer ikke";
              die();
            }


            if (!$ssql) {
        			printf("Error: %s\n", mysqli_error($db));
        			exit();
        		}
          }





        if ($lagny) {
          echo("<form method='POST' action='admin.php'>");
          echo("<table><tr><th>Bruker navn:</th>");
          echo("<th>Passord</th>");
          echo("<th>ePost</th></tr>\n");
          echo("<tr><td><input type='text' name='nybruker' autofocus></td>\n");
          echo("<td><input type='password' name='nyttpw'></td>\n");
          echo("<td><input type='text' name='nyePost'></td></tr>\n");
          echo("</table>");
          echo("<input type='submit' name='lagny' value='Registrer ny bruker'>");
          echo("</form>");
          // lager feltet for å legge til ny bruker
        }
        if($nypwrd){


          echo("<form method='POST' action='admin.php'>");
          echo("<table><tr><th>Gammelt passord</th>");
          echo("<th>Nytt passord</th>");
          echo("<th>Bekreft passord</th></tr>\n");
          echo("<tr><td><input type='password' name='gammeltpw' autofocus></td>\n");
          echo("<td><input type='password' name='nyttPassord'></td>\n");
          echo("<td><input type='password' name='bekreftPassord'></td></tr>\n");
          echo("</table>");
          echo("<input type='submit' name='nypwrd' value='bytt Passord'>");
          echo("</form>");
          // lager feltet for endring av passord

        }
      ?>
		</div>
	</body>
</html>
