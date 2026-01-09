<?php
	include("dbconnection.php");
	include ('user_session.php');
    include("nav.php");
	$cid = $_SESSION["uid"];
    $query = "SELECT * FROM customer WHERE cus_ID= $cid ";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
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
            <?php echo $row['cus_firstName']; ?> Profile
        </div>
        <div class="details">
            <div class="info">
                <p><strong>First Name</strong>&emsp;&emsp;&nbsp;: 
					<input name="Fname" type="text" value="<?php echo $row['cus_firstName']; ?>" readonly>
				</p>
				<p><strong>Last Name</strong>&emsp;&emsp;&nbsp;: 
					<input name="Lname" type="text" value="<?php echo $row['cus_lastName']; ?>" readonly>
				</p>
				<p><strong>Password</strong>&emsp;&emsp;&nbsp;&nbsp;: 
					<input name="pass" type="text" value="<?php echo $row['cus_password']; ?>" readonly>
				</p>
				<p><strong>Email Address</strong>&nbsp;: 
					<input name="email" type="text" value="<?php echo $row['cus_email']; ?>" readonly>
				</p>
            </div>
            <div class="button_edit">
                <button onclick="window.location.href='edit_profile.php?edit&cus_ID=<?php echo $row['cus_ID'];?>';" style="border-radius: 1em; background-color: bisque; color: black; width: 50%;">
                    Edit Profile
                </button>
            </div>
            <div class="button_order_history">
                <button onclick="window.location.href='order_history.php';" style="border-radius: 1em; background-color: bisque; color: black; width: 50%;">
                    View Order History 
                </button>
            </div>
        </div>
        <div class="button_logout">
            <button style="border-radius: 1em; background-color: #726E6D; color: white; width:25%; margin-bottom: 5%;" onclick='location.href="logout.php"'>
                Log Out
            </button>
        </div>
        
    </div>
    <?php
        include("Footer.php");
		mysqli_close($connect);
    ?>
</body>
<html>