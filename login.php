<?php
include("dbconnection.php");
session_start();
?>
<html>
<head>
	<title>Sign in form</title>
	<link rel="stylesheet" type="text/css" href="login.css" />
</head>

<body>
	<div class="container">
		<div class="form">
			
			<div class="button-box">
			  <div id="btn"></div>
			  <button type="button" class="toggle-btn" onclick="cusLogin()">Customer</button>
			  <button type="button" class="toggle-btn" onclick="adminLogin()">Admin</button>
			</div>
			
			<a href="Main.php"><img src="img/Pizz.png" alt="Pizza-logo"></a>
			
			<form id="customer-login" class="input-group" method="post">
			  <label for="email"><b>Email address</b></label>
			  <input type="text" placeholder="Enter Email Address" name="email" required>
			  <label for="psw"><b>Password</b></label>
			  <input type="password" placeholder="Enter Password" name="psw" required>
			  <button type="submit" class="submit-btn" name="checkbtn">Log in</button>
			  <div class="link-group">
				<a href="forgot_pass.php" class="forpass">Forgot password?</a>
				<a href="register.php" class="create-account">Create Account</a>
			  </div>
			</form>
			
			<form id="admin-login" class="input-group" method="post">
			  <label for="admin"><b>Admin/Rider Name</b></label>
			  <input type="text" placeholder="Enter Admin/Rider Name" name="admin" required>
			  <label for="adminpsw"><b>Password</b></label>
			  <input type="password" placeholder="Enter Admin/Rider Password" name="adminpsw" required>
			  <button type="submit" class="submit-btn" name="checkbtn-admin">Log in</button>
			</form>
		</div>
	</div>
	<script>
		var x = document.getElementById("customer-login");
		var y = document.getElementById("admin-login");
		var z = document.getElementById("btn");
		
		function cusLogin(){
			x.style.left = "50px";
			y.style.left = "450px";
			z.style.left = "0";
		}
		function adminLogin(){
			x.style.left = "-400px";
			y.style.left = "50px";
			z.style.left = "110px";
		}
	</script>

</body>
</html>

<?php 

if(isset($_POST['checkbtn'])) 
{
    $email = $_POST['email'];
    $pass = $_POST['psw'];

    $query = "SELECT * FROM customer WHERE cus_email='$email' AND BINARY cus_password='$pass'";

    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);

    if (is_array($row)) 
    {
        $_SESSION["email"]=$row['cus_email'];
        $_SESSION["pass"]=$row['cus_password'];
        $_SESSION["uid"]=$row['cus_ID'];
		$_SESSION["username"]=$row['cus_firstName'];

		echo "<meta http-equiv='refresh' content='0;URL=after_main.php'>";
		echo "<script type='text/javascript'>";
        echo "alert('Welcome back to Pizz pizza');";
        echo "</script>";
        exit();
    }
    else
    {
        echo "<script type='text/javascript'>";
        echo "alert('Your name or password is incorrect!');";
        echo "</script>";
    }
}

if (isset($_POST['checkbtn-admin'])) 
{
    $adminName= $_POST['admin'];
    $adminPass = $_POST['adminpsw'];

    $adminQuery = "SELECT * FROM admin WHERE admin_username='$adminName' AND BINARY admin_password='$adminPass'";
    $adminResult = mysqli_query($connect, $adminQuery);
    $adminRow = mysqli_fetch_array($adminResult);
	
	$riderQuery = "SELECT * FROM rider WHERE rider_username='$adminName' AND BINARY rider_password='$adminPass'";
    $riderResult = mysqli_query($connect, $riderQuery);
    $riderRow = mysqli_fetch_array($riderResult);
	

    if (is_array($adminRow)) 
    {
		$_SESSION["adminID"]=$adminRow['admin_ID'];
        $_SESSION["adminPass"]=$adminRow['admin_password'];
		$_SESSION["adminName"]=$adminRow['admin_username'];

		echo "<meta http-equiv='refresh' content='0;URL=admin_product_list.php'>";;
        exit();
    }
	else if(is_array($riderRow))
	{
		$_SESSION["riderID"]=$riderRow['rider_ID'];
        $_SESSION["riderPass"]=$riderRow['rider_password'];
		$_SESSION["riderName"]=$riderRow['rider_username'];

		echo "<meta http-equiv='refresh' content='0;URL=rider_accept.php'>";
        exit();
    }
    else
    {
        echo "<script type='text/javascript'>";
        echo "alert('Your admin ID or password is incorrect!');";
        echo "</script>";
    }
}
mysqli_close($connect);

?>