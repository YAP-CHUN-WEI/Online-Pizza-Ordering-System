<?php 
	include("dbconnection.php");
	if(session_status() === PHP_SESSION_NONE)
	{
		session_start();
	}
	$query = "SELECT * FROM admin";
	$result = mysqli_query($connect, $query);
	$row = mysqli_fetch_array($result);
?>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Navigation bar</title>
	<style>
		*{
			margin: 0;
			padding: 0;
			box-sizing: border-box;
		}
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
		.inner-last img{
			margin-left:30px;
			height:75px;
			float:right;
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
	<div class="nav-bar">
		<div class="inner-logo">
			<a href="Main.php">
				<img src="img/Pizz.png" alt="Pizza-logo">
			</a>
		</div>
		<div class="inner-text">
			<a href="admin_product_list.php">Edit Menu</a>
			<a href="sales_report.php">Sales Report</a>
		</div>
		<div class="inner-last">
			<a href="admin_profile.php?edit&admin_ID=<?php echo $row["admin_ID"];?>"><img src="img/admin1.png" alt="My profile"></a>
		</div>
	</div>
	</header>
</body>
</html>