<?php
	function lagMeny($db) {
		/*
		echo'<nav id="nav" role="navigation">';
		echo('<ul>');
		*/
		$stmt = $db->prepare("SELECT * FROM vikerfjell.meny");
		mysqli_set_charset($db, "UTF8");
		$stmt->execute();
		$result = $stmt->get_result();

		$sub_id = '';

		while($row = $result->fetch_assoc()){

			$idmeny = $row['idmeny'];
			$kontroll = null;

			$tekst = $row['tekst'];
			$side = $row['side'];
			$phpadd = "php/";
			if ($idmeny=='1') {
				echo("<li><a href=../$side>$tekst</a>");

			} else {
				echo("<li><a href=$phpadd$side>$tekst</a>");
			}
	/*
				$sub_stmt = $db->prepare("SELECT * from submeny WHERE meny_idmeny = $idmeny");
				$sub_stmt->execute();
				$sub_result = $sub_stmt->get_result();

				while($sub_row = $sub_result->fetch_assoc()){
					$idsubmeny = $sub_row['idsubmeny'];
					$sub_tekst = $sub_row['sub_tekst'];
					$sub_side = $sub_row['sub_side'];

					if($kontroll == 1) {
							echo("<a href = $sub_side>$sub_tekst</a>");
					} else {
							echo("<div class ='dropdown'>");
							echo("<button class = 'dropbtn'>$tekst</button>");
							echo("<div class = 'dropdown-content'>");
							echo("<a href = $sub_side>$sub_tekst</a>");

							$kontroll = 1;
					}
				}
			if ($kontroll == 1) {
				echo("</div></div>");
			} */
			echo("</li>");
		}

			//echo("<li><a href=$side>$tekst</a></li>");

		/*
		echo('</ul>');
		echo('</nav>');
		*/
	}
	function lagSideMeny($db) {
		$stmt = $db->prepare("SELECT * FROM vikerfjell.meny");
		mysqli_set_charset($db, "UTF8");
		$stmt->execute();
		$result = $stmt->get_result();

		while($row = $result->fetch_assoc()) {
			$tekst = $row['tekst'];
			$idmeny = $row['idmeny'];

		}
	}

			$array = "";
		$idmenymeny ="";

		function adminRediger($db) {
		global $idmenymeny;
		global $array;
		$array = array();
		/*
		echo'<nav id="nav" role="navigation">';
		echo('<ul>');
		*/
		$stmt = $db->prepare("SELECT * FROM vikerfjell.meny");
		mysqli_set_charset($db, "UTF8");
		$stmt->execute();
		$result = $stmt->get_result();

		$sub_id = '';

		while($row = $result->fetch_assoc()){

			$idmenymeny = $row['idmeny'];
			$kontroll = null;


			$tekst = $row['tekst'];
			$side = $row['side'];
			$array[] = $idmenymeny;

			$_SESSION['idmenymeny'] = $idmenymeny;
			$_GET['idmenymeny'] = $idmenymeny;

			echo("<form method='POST'>");
			echo("<li><button name='knappenavn' value=$idmenymeny>$tekst</button>");
		//	echo("<li><a href='new2.php onclick=".$_GET['idmenymeny']."'>$tekst</a>");
			//echo("<li><a href='new2.php onclick=".$_GET['idmenymeny']."'>$tekst</a>");
			echo("</form>");
				$sub_stmt = $db->prepare("SELECT * from submeny WHERE meny_idmeny = $idmenymeny");
				$sub_stmt->execute();
				$sub_result = $sub_stmt->get_result();
/*
				while($sub_row = $sub_result->fetch_assoc()){
					$idsubmeny = $sub_row['idsubmeny'];
					$sub_tekst = $sub_row['sub_tekst'];
					$sub_side = $sub_row['sub_side'];

					if($kontroll == 1) {
							echo("<a href = $sub_side>$sub_tekst</a>");
					} else {
							echo("<div class ='dropdown'>");
							echo("<button class = 'dropbtn'>$tekst</button>");
							echo("<div class = 'dropdown-content'>");
							echo("<a href = $sub_side>$sub_tekst</a>");

							$kontroll = 1;
					}
				}
			if ($kontroll == 1) {
				echo("</div></div>");
			} */
			echo("</li>");
		}

			//echo("<li><a href=$side>$tekst</a></li>");

		/*
		echo('</ul>');
		echo('</nav>');
		*/

	}
?>
