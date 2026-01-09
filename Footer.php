<?php
	include("dbconnection.php"); 
	if(session_status() === PHP_SESSION_NONE)
	{
		session_start();
	}
	$username="";
	
    ?>
<!DOCTYPE html>
<html>
<head>
	<title>Footer</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
		div{
			display:block;
		}
		.container{
			width:100%;
			margin-left:auto;
			margin-right:auto;
			padding-left:35px;
			padding-right:35px;
		}
		footer {
			width:100%;
			background-color: #1a1a1a;
			color: white;
			padding:35px 20px;
			line-height:1.75;
		}
		.container{
			align-items: center!important;
			justify-content: center!important;
		}
		.center-word{
			text-align:center;
			margin-top:25px;
			margin-left:150px;
			margin-right:75px;
			border-top:1px solid white;
			padding-top:25px;
		}
		.upper{
			display:flex;
			flex-wrap:wrap;
			justify-content:space-between;
		}
		.upper a{
			text-decoration:none;
			color:white;
			margin:10px;
		}
		.upper img{
			height:50px;
		}
		a:hover{
			color: blue;
			background-color: transparent;
			text-decoration: underline;
		}
		button {
		  border: none;
		  background-color: red;
		  padding: 15px 32px;
		  text-align: center;
		  text-decoration: none;
		  display: inline-block;
		  font-size: 16px;
		  margin: 4px 2px;
		  cursor: pointer;
		}
	</style>
</head>
<body>
<footer>
	<?php
	if(empty($_SESSION['username']))
	{
	?>
	<div class="container">

	<div class="upper">
		<img src="Img/Pizz.png" alt="Pizz-logo">
		<button type="button"><a href="about_us.php">About Us</a></button>
		<button type="button"><a href="contact_us.php">Contact Us</a></button>
		<button type="button"><a href="privacy_policy.php">Privacy Policy</a></button>
		<button type="button"><a href="Main.php#second">Location</a></button>
		<button type="button"><a href="register.php">Create a Account</a></button>
		<button type="button"><a href="login.php">Sign In</a></button>
	</div>
	
	<div class="center-word">
		Compatible with Internet Explorer 10.0 above, Google Chrome Version 24.0 and above Prices shown are inclusive of 0% GST. 
		Servings featured are for illustration purposes only. Combo and price may vary according to location. Shoule any discrepancy occur in published price, 
		the pricing at the store point of purchase is deemed final. PIZZ pizza reserves the right to change and / or remove items from menu without prior notice.
	</div>
</div>
</footer>
	<?php 
	}
		else
		{
	?>
	<footer>
	<div class="container">

	<div class="upper">
		<img src="Img/Pizz.png" alt="Pizz-logo">
		<button type="button"><a href="about_us.php">About Us</a></button>
		<button type="button"><a href="contact_us.php">Contact Us</a></button>
		<button type="button"><a href="privacy_policy.php">Privacy Policy</a></button>
		<button type="button"><a href="after_main.php#second">Location</a></button>
		<button type="button"><a href="logout.php">Sign Out</a></button>
	</div>
	
	<div class="center-word">
		Compatible with Internet Explorer 10.0 above, Google Chrome Version 24.0 and above Prices shown are inclusive of 0% GST. 
		Servings featured are for illustration purposes only. Combo and price may vary according to location. Shoule any discrepancy occur in published price, 
		the pricing at the store point of purchase is deemed final. PIZZ pizza reserves the right to change and / or remove items from menu without prior notice.
	</div>
</div>
	</footer>
		<?php
		}
	?>
</body>
</html>