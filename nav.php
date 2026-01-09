<?php
	include("dbconnection.php"); 
	if(session_status() === PHP_SESSION_NONE)
	{
		session_start();
	}
	$query = "SELECT * FROM customer";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
	$username="";
	
    ?>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/92cf595352.js" crossorigin="anonymous"></script>
	<title>Navigation bar</title>
	<style>
		div{
			display:block;
			height:auto;
		}
		.nav-bar{
			display: flex;
			justify-content: space-around;
			align-items: center;
			right: 0;
			left: 0;
			background-color:rgba(255, 255, 255, 0.751);
			box-shadow: 0 0 10px rgba(0, 0, 0,0.5);
			z-index: 1000;
		}
		.inner-logo img{
			height:75px;
			margin-right:30px;
		}
		.inner-text{
			margin:35px;
			font-weight: bold;
		}
		.inner-text a{
			margin:15px;
			text-decoration:none;
			color:black;
			font-size:20px;
			text-align:center;
			letter-spacing:0.05em
		}
		.inner-text a:hover{
			font-weight:bold;
			color:grey;
		}
		.inner-last {
			display: flex;
			align-items: center;
			column-gap:20px;
		}
		.inner-last a {
		  text-decoration: none;
		  color: black;
		  font-size: 30px;
		  text-transform:uppercase;
		}
		.nav-bar.scroll-up {
		  transform: translateY(-100%);
		}
		.nav-bar {
		  transition: transform 0.3s ease;
		}
	</style>
	<script>
	  window.addEventListener('scroll', function() {
		var navBar = document.querySelector('.nav-bar');
		if (window.scrollY > 100) {
		  navBar.classList.add('scroll-up');
		} else {
		  navBar.classList.remove('scroll-up');
		}
	  });
	</script>
</head>
<body>
	<header>
	<?php
	if(empty($_SESSION['username']))
	{
	?>
	<div class="nav-bar">
	
		<div class="inner-logo">
			<a href="Main.php">
				<img src="img/Pizz.png" alt="Pizza-logo">
			</a>
		</div>
		<div class="inner-text">
			<a href="Main.php">Home</a>
			<a href="product_list.php">Food Menu</a>
			<a href="Main.php#second">Location</a>
			<a href="register.php">Register</a>
		</div>
		<div class="inner-last">
			<a href="login.php"><i class="fa-solid fa-right-to-bracket  fa-xl"></i></a>
			<a href="add_to_cart.php"><i class="fa-sharp fa-solid fa-cart-plus fa-xl"></i></a>
		</div>
	</div>
	</header>
	<?php 
	}
		else
		{
	?>
	<header>
	<div class="nav-bar">
		<div class="inner-logo">
			<a href="Main.php">
				<img src="img/Pizz.png" alt="Pizza-logo">
			</a>
		</div>
		<div class="inner-text">
			<a href="after_main.php">Home</a>
			<a href="after_product_list.php">Food Menu</a>
			<a href="after_main.php#second">Location</a>
			<a href="logout.php">Sign Out</a>
		</div>
		<div class="inner-last">
			<a href="user_profile.php"><?php echo $_SESSION['username'] ?></a>
			<a href="add_to_cart.php"><i class="fa-sharp fa-solid fa-cart-plus fa-xl"></i></a>
		</div>
	</div>
	</header>
	<?php
		}
	?>
</body>
</html>
	