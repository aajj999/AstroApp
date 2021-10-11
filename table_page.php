<html>

<title>Table</title>

<head>

</head>


<body style = "background-color : #99CCFF; font-family : candara">
	
	<button onclick="window.location.href = './AstroApp.php';">Change the parameters</button><br><br>
	
	<font size="5">
		<table width="60%">
		<tr>
		<th>NAME</th>
		<th>AZIMUTH</th>
		<th>ALTITUDE</th>
		</tr>
		
		<?php
		
		$sec = file_get_contents('../../secret.txt');
		
		$esec = explode(", ", $sec);
		
		$conn = oci_connect($esec[0], $esec[1], $esec[2]);
		
		if (!$conn) {
			echo "oci_connect failed";
			$e = oci_error();
			echo $e['message'];
		}

		$jasSzuk = htmlspecialchars($_POST['suwak-jasnosc']);
		$wysSzuk = htmlspecialchars($_POST['komorka-wys']);
		
		$dl = htmlspecialchars($_POST['dl_geo']);
		$sz = htmlspecialchars($_POST['sz_geo']);
		
		$g = $_POST['godzina'];
		$m = $_POST['minuta'];
		$d = $_POST['dzien'];
		
		$UT = (htmlspecialchars($m) / 60) + htmlspecialchars($g);
		
		$jds = 2458849.46;
		$jd = $jds + $d + $g / 24 + $m / (24 * 60);
		$jc = ($jd - 2451545) / 36525;
		$gmls = (280.46646 + $jc * (36000.76983 + $jc * 0.0003032)) % 360;
		$gmas = 357.52911 + $jc * (35999.05029 - 0.0001537 * $jc);
		$seoc = SIN( deg2rad( $gmas )) * (1.914602 - $jc * (0.004817 + 0.000014 * $jc)) + SIN( deg2rad(2 * $gmas)) * (0.019993 - 0.000101 * $jc) + SIN( deg2rad(3 * $gmas)) * 0.000289;
		$stl = $gmls + $seoc;
		$moe = 23 + (26 + ((21.448 - $jc * (46.815 + $jc * (0.00059 - $jc * 0.001813)))) / 60) / 60;
		$sal = $stl - 0.00569 - 0.00478 * SIN( deg2rad(125.04 - 1934.136 * $jc));
		$oc = $moe + 0.00256 * cos(deg2rad(125.04 - 1934.136 * $jc));
		$E = -11.7 / 60;
		$rs = rad2deg( atan2( cos( deg2rad( $oc)) * sin( deg2rad( $sal)), cos( deg2rad( $sal))));
		$pts = ($E + $UT) * 15;
		$kgs = $pts - 180;
		$T = $rs + $kgs;
		
		if($_POST['guzik-kierunek'] == 'All around'){
		    $query = "SELECT * FROM (SELECT nazwa, ROUND( ACOS( ( SIN(wysokosc * ACOS(-1) / 180) * SIN( $sz * ACOS(-1) / 180) - SIN(deklinacja * ACOS(-1) / 180)) / ( COS(wysokosc * ACOS(-1) / 180) * COS($sz * ACOS(-1) / 180))) * 180 / ACOS(-1), 3) AS azymut, wysokosc, opis FROM (SELECT nazwa, deklinacja, ROUND( ASIN( COS(($T - rektascensja) * ACOS(-1) / 180) * COS(deklinacja * ACOS(-1) / 180) * COS($sz * ACOS(-1) / 180) + SIN(deklinacja * ACOS(-1) / 180) * SIN($sz * ACOS(-1) / 180)) * 180 / ACOS(-1), 3) AS wysokosc, opis FROM obiekt_astronomiczny WHERE jasnosc<=$jasSzuk ORDER BY jasnosc) WHERE wysokosc>=$wysSzuk)";
		}
		if($_POST['guzik-kierunek'] == 'S'){
			$query = "SELECT * FROM (SELECT nazwa, ROUND( ACOS( ( SIN(wysokosc * ACOS(-1) / 180) * SIN( $sz * ACOS(-1) / 180) - SIN(deklinacja * ACOS(-1) / 180)) / ( COS(wysokosc * ACOS(-1) / 180) * COS($sz * ACOS(-1) / 180))) * 180 / ACOS(-1), 3) AS azymut, wysokosc, opis FROM (SELECT nazwa, deklinacja, ROUND( ASIN( COS(($T - rektascensja) * ACOS(-1) / 180) * COS(deklinacja * ACOS(-1) / 180) * COS($sz * ACOS(-1) / 180) + SIN(deklinacja * ACOS(-1) / 180) * SIN($sz * ACOS(-1) / 180)) * 180 / ACOS(-1), 3) AS wysokosc, opis FROM obiekt_astronomiczny WHERE jasnosc<=$jasSzuk ORDER BY jasnosc) WHERE wysokosc>=$wysSzuk) WHERE (azymut<=90 OR azymut>=270)";
		}
		if($_POST['guzik-kierunek'] == 'W'){
			$query = "SELECT * FROM (SELECT nazwa, ROUND( ACOS( ( SIN(wysokosc * ACOS(-1) / 180) * SIN( $sz * ACOS(-1) / 180) - SIN(deklinacja * ACOS(-1) / 180)) / ( COS(wysokosc * ACOS(-1) / 180) * COS($sz * ACOS(-1) / 180))) * 180 / ACOS(-1), 3) AS azymut, wysokosc, opis FROM (SELECT nazwa, deklinacja, ROUND( ASIN( COS(($T - rektascensja) * ACOS(-1) / 180) * COS(deklinacja * ACOS(-1) / 180) * COS($sz * ACOS(-1) / 180) + SIN(deklinacja * ACOS(-1) / 180) * SIN($sz * ACOS(-1) / 180)) * 180 / ACOS(-1), 3) AS wysokosc, opis FROM obiekt_astronomiczny WHERE jasnosc<=$jasSzuk ORDER BY jasnosc) WHERE wysokosc>=$wysSzuk) WHERE azymut<=180";
		}
		if($_POST['guzik-kierunek'] == 'E'){
			$query = "SELECT * FROM (SELECT nazwa, ROUND( ACOS( ( SIN(wysokosc * ACOS(-1) / 180) * SIN( $sz * ACOS(-1) / 180) - SIN(deklinacja * ACOS(-1) / 180)) / ( COS(wysokosc * ACOS(-1) / 180) * COS($sz * ACOS(-1) / 180))) * 180 / ACOS(-1), 3) AS azymut, wysokosc, opis FROM (SELECT nazwa, deklinacja, ROUND( ASIN( COS(($T - rektascensja) * ACOS(-1) / 180) * COS(deklinacja * ACOS(-1) / 180) * COS($sz * ACOS(-1) / 180) + SIN(deklinacja * ACOS(-1) / 180) * SIN($sz * ACOS(-1) / 180)) * 180 / ACOS(-1), 3) AS wysokosc, opis FROM obiekt_astronomiczny WHERE jasnosc<=$jasSzuk ORDER BY jasnosc) WHERE wysokosc>=$wysSzuk) WHERE azymut>=180";
		}
		if($_POST['guzik-kierunek'] == 'N'){
			$query = "SELECT * FROM (SELECT nazwa, ROUND( ACOS( ( SIN(wysokosc * ACOS(-1) / 180) * SIN( $sz * ACOS(-1) / 180) - SIN(deklinacja * ACOS(-1) / 180)) / ( COS(wysokosc * ACOS(-1) / 180) * COS($sz * ACOS(-1) / 180))) * 180 / ACOS(-1), 3) AS azymut, wysokosc, opis FROM (SELECT nazwa, deklinacja, ROUND( ASIN( COS(($T - rektascensja) * ACOS(-1) / 180) * COS(deklinacja * ACOS(-1) / 180) * COS($sz * ACOS(-1) / 180) + SIN(deklinacja * ACOS(-1) / 180) * SIN($sz * ACOS(-1) / 180)) * 180 / ACOS(-1), 3) AS wysokosc, opis FROM obiekt_astronomiczny WHERE jasnosc<=$jasSzuk ORDER BY jasnosc) WHERE wysokosc>=$wysSzuk) WHERE azymut>=90 AND azymut<=270";
		}
		
		$sql = oci_parse($conn, $query);
		$r = oci_execute($sql);
		
		if (!$r) {
			$e = oci_error($sql);
			print htmlentities($e['message']);
			print "\n<pre>\n";
			print htmlentities($e['sqltext']);
			printf("\n%".($e['offset']+1)."s", "^");
			print  "\n</pre>\n";
		}

		while($row = oci_fetch_array($sql, OCI_BOTH)) {
			echo "<tr>";
			?><td><a href="<?php echo $row['OPIS']?>" target="_blank"> <?php echo $row['NAZWA'] ?></a></td><?php ;
			echo "<td>" . $row['AZYMUT'] . "</td>";
			echo "<td>" . $row['WYSOKOSC'] . "</td>";
			echo "</tr>";
		}
		oci_close($conn);
		
		?>
		
		
		</table>
	</font>

</body>
</html>
