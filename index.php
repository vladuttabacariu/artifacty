<!DOCTYPE html5>
<html>
	<?php include 'includes/header.php'; ?>
	<body onload="worldmapvar = new worldMap(document.getElementById('map'))">   
		<?php include 'includes/navigationBar.php'; ?>
		<div id="container">
			<div id="topContainer">
				<div id="slideshow">
					<div>
						<a href=""><img src="images/slider/slider1.jpg"></a>
					</div>
					<div>
						<a href=""><img src="images/slider/slider2.jpg"></a>
					</div>
					<div>
						<a href=""><img src="images/slider/slider3.jpg"></a>
					</div>
					<div>
						<a href=""><img src="images/slider/slider4.jpg"></a>
					</div>
					<div>
						<a href=""><img src="images/slider/slider5.jpg"></a>
					</div>
				</div>
				<div id="leftTopContainer">
					<span>Welcome to the new ARTIFACTY website. There are a number of new features of the website that will make it easier and more enjoyable to use. Please read the <a href="">'About'</a> this site section for more details. </span>
				</div>
			</div>
			<div class="h3">
				<h3>EXPLORE THE ARCHAEOLOGICAL WORLD</h3>
			</div>
			<div id="worldMapContainer">
				<div id="displayCountry" class="clearfix"></div>
				<object id="map" data="worldMap.svg" type="image/svg+xml"></object>
			</div>
		</div>
	</body>
	<?php include 'includes/footer.php'; ?>
</html>