<!DOCTYPE html>
<html>
<head>
	<title>Sign up Form</title>
	<link rel="stylesheet" href="register.css">
</head>
<body>
	<a href="Main.php"><img src="Img/Pizz.png" alt="Pizz-logo" class="logo"></a>
	<div class="signup-box">
		<h1>Register</h1>
		<h4>It's free and only takes a minute</h4>
		<form method="post">
			<label for="name">First Name:</label>
			<input type="text" placeholder="Jaden" id="name" name="Fname" required><br><br>
			
			<label for="name">Last Name:</label>
			<input type="text" placeholder="Martin Sujay" id="name" name="Lname" required><br><br>
			
			<label for="email">Email:</label>
			<input type="email" placeholder="123abc@gmail.com" id="email" name="email" required><br><br>
			
			<label for="password">Password:</label>
			<input type="password" placeholder="sadDAS!#!@123" id="password" name="password" required><br><br>
			
			<label for="confirm_password">Confirm Password:</label>
			<input type="password" placeholder="sadDAS!#!@123" id="confirm_password" name="confirm_password" required><br><br>
			
			<input type="submit" value="Register" name="savebtn">
			
			<p>Already have an account?<a href="login.php"> Login here</a></p>
		</form>
	</div>
</body>
</html>

<?php
    include("dbconnection.php");
    if(isset($_POST["savebtn"])) 	
    {
        $fname = $_POST["Fname"]; 
		$lname = $_POST["Lname"];
		$email = $_POST["email"]; 
        $pass = $_POST["password"]; 	

        $query="INSERT INTO customer(cus_firstName,cus_lastName,cus_email,cus_password) 
        VALUES('$fname','$lname','$email','$pass')";
        mysqli_query($connect,$query);
        
        mysqli_close($connect);
        ?>
        
            <script type="text/javascript">
                alert("<?php echo $fname .' are success register! Please remember login again.'?>");
            </script>
        
        <?php
		echo '<meta http-equiv="refresh" content="0;URL=Main.php">';
    }
?>