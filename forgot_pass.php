<?php
include("dbconnection.php");
session_start();
?>

<html>
<head>
	<title>Forget password form</title>
	<link rel="stylesheet" type="text/css" href="forgot_pass.css" />
	<script type="text/javascript">
		function showNewPasswordForm() {
			var oldForm = document.getElementById("customer-login");
			var newPasswordForm = document.getElementById("new-password-form");

			oldForm.style.display = "none";
			newPasswordForm.style.display = "block";
		}
	</script>
</head>

<body>
	<div class="container">
		<div class="form">
			<a href="Main.php"><img src="img/Pizz.png" alt="Pizza-logo"></a>
			<form id="customer-login" class="input-group" method="post">
				<label for="lname"><b>Last name</b></label>
				<input type="text" placeholder="Type your last name to verify" name="lname" required>
				<label for="email"><b>Email address</b></label>
				<input type="text" placeholder="Type your email address" name="email" required>
				<button type="submit" class="submit-btn" name="checkbtn">Next step</button>
				<input class="submit-btn" type="button" value="Back" onclick="history.back()">
				<a href="register.php" class="create-account" >Create Account</a>
			</form>

			<?php
			if (isset($_POST['checkbtn'])) {
				$email = $_POST['email'];

				$query = "SELECT * FROM customer WHERE cus_email='$email'";
				$result = mysqli_query($connect, $query);

				if (mysqli_num_rows($result) > 0) {
					$row = mysqli_fetch_array($result);
					$cus_email = $row['cus_email'];
					?>
					<form id="new-password-form" class="input-group" method="post">
						<label for="npass"><b>New password</b></label>
						<input type="password" placeholder="Type your new password" name="npass" required>
						<label for="spass"><b>Confirm new password</b></label>
						<input type="password" placeholder="Confirm your new password" name="spass" required>
						<input type="hidden" name="cus_email" value="<?php echo $cus_email; ?>">
						<button type="submit" class="submit-btn" name="checkpassbtn">Change</button>
						<input class="submit-btn" type="button" value="Back" onclick="history.back()">
						<a href="register.php" class="create-account" >Create Account</a>
					</form>
					<?php
					echo "<script type='text/javascript'>";
					echo "showNewPasswordForm();";
					echo "</script>";

					exit();
				} else {
					echo "<script type='text/javascript'>";
					echo "alert('This last name or email address is invalid!');";
					echo "</script>";
					echo "<meta http-equiv='refresh' content='0;URL=forgot_pass.php'>";
				}
			}

			if (isset($_POST['checkpassbtn'])) 
			{
				$newPassword = $_POST['npass'];
				$confirmPassword = $_POST['spass'];
				$cus_email = $_POST['cus_email'];

				if ($newPassword === $confirmPassword) {
					$query = "UPDATE customer SET cus_password='$newPassword' WHERE cus_email='$cus_email'";
					$result = mysqli_query($connect, $query);

					if ($result) {
						echo "<script type='text/javascript'>";
						echo "alert('Password changed successfully! Please login again);";
						echo "</script>";
						echo "<meta http-equiv='refresh' content='0;URL=login.php'>";
						exit();
					} else {
						echo "<script type='text/javascript'>";
						echo "alert('Failed to change the password. Please try again.');";
						echo "</script>";
					}
				} else {
					echo "<script type='text/javascript'>";
					echo "alert('The new passwords do not match! Please retry again');";
					echo "</script>";
				}
			}

			mysqli_close($connect);
			?>

		</div>
	</div>
</body>
</html>
