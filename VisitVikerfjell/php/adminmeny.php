<?php
	session_start();
	include("db.php");
	include("meny.php");
	include("redigermeny.php");
	if(!$_SESSION['bruker']) {
		header('location:logginn.php');
		die();
	}
	if(isset($_POST['nymeny'])) {
		$menynavn = mysqli_real_escape_string($db,$_POST['menynavn']);
		
		$msql = "INSERT INTO meny (tekst) VALUES ('$menynavn')";
		$smsql = mysqli_query($db,$msql);
		unset($_POST['nymeny']);
	}
	if(isset($_POST['send'])) {
		$teksten = mysqli_real_escape_string($db,$_POST['tekst']);
		$id = $_POST['send'];
		
		$rsql = "UPDATE meny SET tekst = '$teksten' WHERE idmeny = '$id'";
		$srsql = mysqli_query($db,$rsql);
		unset($_POST['send']);
	}
	if(isset($_POST['slett'])) {
		$id = $_POST['slett'];
		
		$ssql = "DELETE FROM `vikerfjell`.`meny` WHERE `idmeny`='$id'";
		$sssql = mysqli_query($db,$ssql);
		unset($_POST['send']);
	}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../CSS/adminmeny.css">
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
			<div class="leggTil">
				<h2>Legg til element i meny</h2>
			<!--
				<button type="button" onClick="vislForm()">Legg til element i meny</button>
				<button type="button" onClick="visrForm()">Rediger element i meny</button>
				<button type="button" onClick="vissForm()">Slett element i meny</button> -->

				<form method="POST" action="" id="lForm" class="lForm">
					<table>
						<tr><td>Navn på siden: </td>
						<td><input type='text' name='menynavn' autofocus></td></tr>
						<tr><td><input type='submit' class='nymeny' name='nymeny' value='Legg til nytt element'></td></tr>
					</table>
				</form>
			</div>
			<div class="rediger">
				<h2>Rediger element i meny</h2>
				<!--<form action="" method="POST" id="rForm" class="rForm">-->
					<table>
						<?php
							visred($db);
						?>
					</table>
				<!--</form>-->
			</div>
			<div class="slett">
				<h2>Slett element i meny</h2>
				<!--<form action="POST" id="sForm" class="sForm">-->
					<table>
						<?php
							visslett($db);
						?>
					</table>
				<!--</form>-->
			</div>
			<script>
			/*
				var lForm = document.getElementById('lForm');
				var sForm = document.getElementById('sForm');
				var rForm = document.getElementById('rForm');
				function vislForm() {
					lForm.style.display='block';
					sForm.style.display='none';
					rForm.style.display='none';
				}
				function visrForm() {
					lForm.style.display='none';
					sForm.style.display='none';
					rForm.style.display='block';
				}
				function vissForm() {
					lForm.style.display='none';
					sForm.style.display='block';
					rForm.style.display='none';
				} */
			</script>
		</div>
	</body>
</html>
