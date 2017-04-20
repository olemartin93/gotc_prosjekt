<?php

	function listmeny($db) {
		$stmt = $db->prepare("SELECT * FROM vikerfjell.meny");
		mysqli_set_charset($db, "UTF8");
		$stmt->execute();
		$result = $stmt->get_result();

		$idmeny = $row['idmeny'];

		while($row = $result->fetch_assoc()){
			$kontroll = null;

			$tekst = $row['tekst'];
			$side = $row['side'];
			$phpadd = "php/";

			echo("<li><a href=$phpadd$side>$tekst</a>");
		}
	}
	function visLeggtil($db){
		//$idmeny = mysqli_real_escape_string($db,$_POST['idmeny']);
		//$tekst = mysqli_real_escape_string($db,$_POST['tekst']);
		//$side = mysqli_real_escape_string($db,$_POST['side']);

		
	
		


		//$lsql = "INSERT INTO meny (tekst, side) VALUES ('$tekst', '$side')";
		//$ssql = mysqli_query($db,$lsql);

	}
	function visred($db) {
		/*echo("<tr><td class='w30' id='td1_".$row['idmeny']."'>".$row['tekst']."</td>\n");
		echo("<td class='w25' id='td2_".$row['idmeny']."'>".$row['side']."</td>\n");
		echo("</tr>")*/

		
		$stmt = $db->prepare("SELECT * FROM vikerfjell.meny");
		mysqli_set_charset($db, "UTF8");
		$stmt->execute();
		$resultat = $stmt->get_result();
		
		while($row = $resultat->fetch_assoc()) {
			$tekst = $row['tekst'];
			$idmeny = $row['idmeny'];
			echo("<form action='' method='POST' id='rForm' class='rForm'>");
			echo("<tr><td>$tekst");
			echo("<td><input type='text' class='w30' name='tekst'></td>\n");
			//echo("<input type='hidden' name='id' value=>")
			echo("<td><button type='submit' name='send' value='$idmeny'>Oppdater</button></td>\n");
			echo("</tr></form>");
		}
	}
	/*function redmeny($_POST[]) {
		$idmeny = mysqli_real_escape_string($db,$_POST['idmeny']);
		$tekst = mysqli_real_escape_string($db,$_POST['tekst']);

		$osql = "UPDATE meny SET tekst = '$tekst' side = '$side' WHERE idmeny = '$idmeny'";
		$ssql = mysqli_query($db,$osql);
	}*/
	function visslett($db) {
		$stmt = $db->prepare("SELECT * FROM vikerfjell.meny");
		mysqli_set_charset($db, "UTF8");
		$stmt->execute();
		$resultat = $stmt->get_result();
		
		while($row = $resultat->fetch_assoc()) {
			$tekst = $row['tekst'];
			$idmeny = $row['idmeny'];
			$side = $row['side'];
			echo("<form action='' method='POST' id='sForm' class='sForm'>");
			echo("<tr><td class='w30' id='td1_1'>$tekst</td>\n");
			echo("<td class='w25' id='td2_1'>$side</td>\n");
			echo("<td><button type='submit' name='slett' value='$idmeny'>Slett</button></td>\n");
			echo("</tr>");
		}
	}
	function slettmeny() {
		$idmeny = mysqli_real_escape_string($db,$_POST['idmeny']);
		$tekst = mysqli_real_escape_string($db,$_POST['tekst']);
		$side = mysqli_real_escape_string($db,$_POST['side']);

		$slsql = "DELETE FROM meny WHERE idmeny = '$idmeny'";
		$sslsql = mysqli_query($db,$slsql);
	}
?>
