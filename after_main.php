<!DOCTYPE html>
<html>

<head>
	<title>Main Page</title>
	<link rel="stylesheet" type="text/css" href="main_page.css" />
	
	<script>
		const bgImages = ['Img/nico.jpg', 'Img/nico2.jpg', 'Img/nico3.jpg'];

		function changeBgImage() {
		  const randomIndex = Math.floor(Math.random() * bgImages.length);
		  const bgImage = `url(${bgImages[randomIndex]})`;
		  document.querySelector('.container-head').style.backgroundImage = bgImage;
		}

		setInterval(changeBgImage, 1000);
	</script>
</head>

<body>
	<div class="container-head">
		<?php 
			include("dbconnection.php");
			include("user_session.php");
			include("nav.php");
			include("main_status.php");
		?>
		
	</div>
	<div id="second">
		<div class="location">
			<h1>OUR LOCATION</h1>
		</div>
		<div class="map-container">
		  <div class="map-wrapper">
			<div id="map">
			  <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.637940848529!2d101.63431081454155!3d2.9200403978732057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdb72c965ab4cd%3A0x38201f285c241048!2sTamarind%20Square!5e0!3m2!1sen!2smy!4v1676540914904!5m2!1sen!2smy" 
				width="100%" height="450" allowfullscreen="yes"></iframe>
			</div>
		  </div>
		  <div class="text-wrapper">
			<div id="map-text">
			  <strong>PIZZ PIZZA CYBERJAYA</strong>
			  <p>A-03-06, Tamarind Square, Cyberjaya, 63000 Cyberjaya, Selangor</p>
			  <strong>03-5308 4332<br><br></strong>
			  
			  <strong>Operation Hour</strong>
			  <p>Mon – Thu (10.30 AM – 10.30 PM)</p>
			  <p>Fri – Sun (10.30 AM – 11.00 PM)</p>
			</div>
		  </div>
		</div>
	</div>
	<div class="menu">
		<h1>Chef Recommendations</h1>
		<div class="menu-container">
			<table>
				<tr>
					<td><img src="Img/Funghi.jpg" alt="Funghi"></td>
					<td><img src="Img/Bufalina.jpg" alt="Bufalina"></td>
					<td><img src="Img/England Bar.jpg" alt="England Bar"></td>
					<td><img src="Img/Zucca.jpg" alt="Zucca"></td>
					<td><a href="product_list.php" class="seemore-link">See more &rarr;</a></td>
				</tr>
				<tr>
					<th>Funghi</th>
					<th>Bufalina</th>
					<th>England Bar</th>
					<th>Zucca</th>
				</tr>
			</table>
		</div>
	</div>
	<div id="footer">
		<?php include("Footer.php")?>
	</div>

</body>

</html>