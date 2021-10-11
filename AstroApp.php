<!DOCTYPE html>
<html>

<title>Astro app</title>

<head>
	
	<script>
		
		function getLocation() {
			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(setVariables, giveError);
			} else {
				giveError();
			}
		}

		function giveError(){
			alert("Geolocation is not supported by this browser. Change browser or allow access to your location. Now app won't work correctly, but it's given some exemplary coordinates.");
			document.getElementById('dl_geo').value = 21;
			document.getElementById('sz_geo').value = 52;
			<?php date_default_timezone_set('UTC');?>
			document.getElementById('godzina').value = <?php echo  date('H'); ?> ;
			document.getElementById('minuta').value = <?php echo  date('i'); ?> ;
			document.getElementById('minuta').value = <?php echo  date('z'); ?> ;
		}

		function setVariables(position) {
			lat = position.coords.latitude;
			lon = position.coords.longitude;
			
			document.getElementById('dl_geo').value = lon;
			document.getElementById('sz_geo').value = lat;
			
			<?php date_default_timezone_set('UTC');?>
			document.getElementById('godzina').value = <?php echo  date('H'); ?> ;
			document.getElementById('minuta').value = <?php echo  date('i'); ?> ;
			document.getElementById('dzien').value = <?php echo  date('z'); ?> ;
		}
			
		getLocation();
			
	</script>
	
	<style>	
	
		.slider {
		  -webkit-appearance: none;  /* Override default CSS styles */
		  appearance: none;
		  width: 60%;
		  height: 15px;
		  border-radius: 15px;
		  background: white;
		  outline: none; /* Remove outline */
		  opacity: 0.8;
		  -webkit-transition: .2s; /* 0.2 seconds transition on hover */
		  transition: opacity .2s;
		}

		.slider::-webkit-slider-thumb {
		  -webkit-appearance: none;
		  appearance: none;
		  width: 25px;
		  height: 25px;
		  border-radius: 70%; 
		  background: black;
		  cursor: pointer;
		}

	</style>

</head>


<body style = "background-color : #99CCFF; font-family : candara">

	<h1><center>Looking for objects in your sky</center></h1>
	<br><br>

	<form action = "./table_page.php" method = "post">
	
		<h3>ADJUST NUMBER OF VISIBLE OBJECTS IN THE SKY<br>Move right if your sky is dark and left if it's bright</h3>
		<br>

		<input type = "range" min = "0" max = "30" class = "slider" name = "suwak-jasnosc" id = "suwak-jasnosc">
		<br><br>

		<h4>From which altitude up you want to observe? <input type = "text" name = "komorka-wys" id = "komorka-wys" size = "10" value = "0">  Scale in degrees. Horizon has altitude 0 and zenith 90.</h4>
		<br>

		<input type="radio" name="guzik-kierunek" value="All around" checked> All around<br>
		<input type="radio" name="guzik-kierunek" value="N"> N<br>
		<input type="radio" name="guzik-kierunek" value="S"> S<br>
		<input type="radio" name="guzik-kierunek" value="W"> W<br>
		<input type="radio" name="guzik-kierunek" value="E"> E  
		<br>

		<h3>When you click the Explore! button you can find a list of objects you can see in the sky.
		Based on the number of visible objects adjust the luminosity of the
		sky where you are. By clicking name of object you will be able to
		read a description of it. In the table enclosed are azimuth and altitude
		of each of them. If you don't know how to use <a href = "https://en.wikipedia.org/wiki/Horizontal_coordinate_system" target="_blank">horizontal coordinates</a>, 
		read about them.</h3>
		
		<input type = "hidden" name = "dl_geo" id = "dl_geo">
		<input type = "hidden" name = "sz_geo" id = "sz_geo">
		<input type = "hidden" name = "godzina" id = "godzina">
		<input type = "hidden" name = "minuta" id = "minuta">
		<input type = "hidden" name = "dzien" id = "dzien">
		
		<input style="height:70px;width:200px"  type = "submit" value = "Explore!">
		<br>
	
	</form>

</body>
</html>
























