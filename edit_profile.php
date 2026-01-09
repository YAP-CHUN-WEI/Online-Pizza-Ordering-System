<?php
	include("dbconnection.php");
	include ('user_session.php');
    include("nav.php");
	if(isset($_GET['edit']))
	{
		$uid =$_GET["cus_ID"];
		$query= "SELECT * FROM  customer WHERE cus_ID = $uid ";
		$result=mysqli_query($connect,$query);
		$row = mysqli_fetch_assoc($result);
	}
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="user_profile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <div class="content">
        <div class="title">
            My Profile
        </div>
        <div class="details">
		<form method="post">
            <div class="edit_info">
                <p><strong>First name</strong>: 
					<input name="Fname" type="text" value="<?php echo $row['cus_firstName']; ?>">
				</p>
				<p><strong>Last name</strong>: 
					<input name="Lname" type="text" value="<?php echo $row['cus_lastName']; ?>">
				</p>
				<p><strong>Password</strong>: 
					<input name="pass" type="text" value="<?php echo $row['cus_password']; ?>">
				</p>
				<p><strong>Email Address</strong>: 
					<input name="email" type="text" value="<?php echo $row['cus_email']; ?>">
				</p>
            </div>
            <div class="button_edit">
                <button name="savebtn" style="border-radius: 1em; background-color: #3A5F0B; color: white; width: 50%;">
                    Save
                </button>
            </div>
		</form>
        </div>
        <div class="button_logout">
            <button style="border-radius: 1em; background-color: #726E6D; color: white; width:25%;" onclick='location.href="user_profile.php"'>
                Back
            </button>	
        </div>
        
    </div>
    <?php
        include("Footer.php");
    ?>
</body>
<html>
<?php
if (isset($_POST['savebtn'])) 
{
	$fname = $_POST['Fname'];
    $lname = $_POST['Lname'];
	$psw = $_POST['pass'];
    $email = $_POST['email'];
	
	$update = "UPDATE customer set cus_firstName='$fname', cus_lastName='$lname', cus_password='$psw', cus_email='$email' WHERE cus_ID =$uid ";
	$result = mysqli_query($connect, $update);
	echo "<meta http-equiv='refresh' content='0;URL=user_profile.php'>";;
    exit();
}

mysqli_close($connect);
?>