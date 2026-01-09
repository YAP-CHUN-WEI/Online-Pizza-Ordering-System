<!DOCTYPE html>
<html>
<head>
	<title>Feedback List</title>
	<link rel="stylesheet" href="feedback.css">
	<?php
		include("dbconnection.php");
        include("admin_session.php");
        include("admin_nav.php");
		$query= "SELECT * FROM feedback";
		$result=mysqli_query($connect,$query);
	?>
</head>
<body>
	<div class="feedback-list">
	  <h2>Feedback List</h2>
	  <table>
		<thead>
		  <tr>
			<th>Feedback ID</th>
			<th>User Name</th>
			<th>Date</th>
			<th>Time</th>
			<th>Email</th>
			<th>Comments</th>
			<th>Actions</th>
		  </tr>
		</thead>
		<tbody> 
			<?php 
			while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
				echo "<td>" . $row['feedback_ID'] . "</td>";
				echo "<td>" . $row['name'] . "</td>";
				echo "<td>" . $row['feedback_date'] . "</td>";
				echo "<td>" . date("H:i:s", strtotime($row['feedback_time'])) . "</td>";
				echo "<td>" . $row['email'] . "</td>";
				echo "<td>" . $row['feedback_message'] . "</td>";
				echo "<td>
						<form method='post'>
							<input type='hidden' name='fid' value='" . $row['feedback_ID'] . "'>
							<button class='deletebtn' name='deletebtn'>Delete</button>
						</form>
					  </td>";
				echo "</tr>";
			}
			?>
		</tbody>
	  </table>
	</div>
</body>
</html>

<?php
if (isset($_POST['deletebtn'])) {
	$fid = $_POST['fid'];
	$delete = "DELETE FROM feedback WHERE feedback_ID = $fid";
	$result = mysqli_query($connect, $delete);

	if ($result) {
		echo "<meta http-equiv='refresh' content='0;URL=feedback.php'>";
		exit();
	} else {
		echo "Delete failed.";
	}
}
?>
