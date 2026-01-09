<!DOCTYPE html>
<html>
<head>
    <title>Admin Profile</title>
    <link rel="stylesheet" href="admin_profile.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
		include("dbconnection.php");
        include("admin_session.php");
        include("admin_nav.php");
		$aid =$_SESSION["adminID"];
		$query= "SELECT * FROM  admin WHERE admin_ID = $aid ";
		$result=mysqli_query($connect,$query);
		$row = mysqli_fetch_assoc($result);
    ?>
    <script>
		function editName() {
		  var nameInput = document.getElementById("nameInput");

		  nameInput.removeAttribute("readonly");
		  nameInput.classList.add("editable");
		  nameInput.focus();
		  nameInput.select();
		  
		  nameInput.addEventListener("keydown", handleKeyPress);
		}

		function editPass() {
		  var pass = document.getElementById("pass");

		  pass.removeAttribute("readonly");
		  pass.classList.add("editable");
		  pass.focus();
		  pass.select();
		  
		  pass.addEventListener("keydown", handleKeyPress);
		}
		
		function handleKeyPress(event) {
            if (event.keyCode === 27) {
                window.location.reload();
            }
        }
		
		document.addEventListener("keydown", handleKeyPress);
    </script>
</head>
<body>
    <div class="content">
        <div class="title">
            Admin Profile
        </div>
		<form method="post">
			<div class="details">
					<p style="margin: 2% 25%;">Long press <strong>"Esc"</strong> to quit edit</p>
					<p><strong>Admin Name</strong>&emsp;&emsp;&emsp;: 
						<input id="nameInput" name="Aname" type="text" value="<?php echo $row['admin_username']; ?>" >
						<button type="button" class="edit-button" onclick="editName()">Edit</button>
						<button name="saveName" class="edit-button" >Save</button>
					</p>
					<p><strong>Admin Password</strong>&emsp;: 
						<input id="pass" name="pass" type="text" value="<?php echo $row['admin_password']; ?>">
						<button type="button" class="edit-button" onclick="editPass()">Edit</button>
						<button name="savePass" class="edit-button">Save</button>
					</p>
					<p><strong>Position</strong>&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;: 
						<input name="position" type="text" value="<?php echo $row['admin_position']; ?>" readonly>
					</p>
			</div>
		</form>
        <div class="button_edit">
            <button onclick="window.location.href='admin_product_list.php';" style="border-radius: 1em; width: 40%;">
                Edit Menu
            </button>
        </div>
        <div class="button_edit">
            <button onclick="window.location.href='feedback.php';" style="border-radius: 1em; width: 40%;">
                Feedback from customer
            </button>
        </div>
        <div class="button_logout">
            <button style="border-radius: 1em; background-color: #726E6D; color: white; width:25%; margin-bottom: 5%;" onclick="location.href='logout.php'">
                Log Out
            </button>
        </div>   
    </div>
</body>
<html>
<?php
if (isset($_POST['saveName'])) 
{
	$adminName = $_POST['Aname'];
	
	$update = "UPDATE admin set admin_username='$adminName' WHERE admin_ID =$aid ";
	$result = mysqli_query($connect, $update);

	if ($result) {
		echo "<meta http-equiv='refresh' content='0;URL=admin_profile.php?edit&admin_ID=" . $row["admin_ID"] . "'>";
		exit();
	} else {
		echo "Update failed.";
	}
}
else if (isset($_POST['savePass'])) 
{
	$adminpass = $_POST['pass'];
	
	$update2 = "UPDATE admin set admin_password='$adminpass' WHERE admin_ID =$aid ";
	$result2 = mysqli_query($connect, $update2);

	if ($result2) {
		echo "<meta http-equiv='refresh' content='0;URL=admin_profile.php?edit&admin_ID=" . $row["admin_ID"] . "'>";
		exit();
	} else {
		echo "Update failed.";
	}
}
mysqli_close($connect);
?>
