<!DOCTYPE html>
<html>
  <head>
    <title>Contact Us</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="contact_us.css">
    <?php 
      include("dbconnection.php");
      include('user_session.php');
      include("nav.php");
    ?>
  </head>
  <body>
    <main>
      <h1>Contact Us</h1>
      <p>
		Please complete the form below to send us a message. We will respond to you promptly. 
		You have the option to provide an anonymous name and email address, and we will contact you using an anonymous email. 
		Please ensure that the anonymous email address is accessible.
	  </p>
      
      <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" placeholder="Anonymous is allowed" required>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="Anonymous email is allowed" required>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        <input type="hidden" id="date" name="date">
        <input type="hidden" id="time" name="time">
        <button name="saveBtn" type="submit">Send Message</button>
      </form>
      
    </main>
    <?php include("Footer.php")?>
    
    <script>
      document.querySelector("#date").value = new Date().toISOString().slice(0, 10);
      const currentTime = new Date();
      const formattedTime = currentTime.getHours().toString().padStart(2, '0') + ':' +
                            currentTime.getMinutes().toString().padStart(2, '0') + ':' +
                            currentTime.getSeconds().toString().padStart(2, '0');
      document.querySelector("#time").value = formattedTime;
    </script>
  </body>
</html>

<?php
  if(isset($_POST["saveBtn"]))   
  {
    $name = $_POST["name"]; 
    $email = $_POST["email"];
    $msg = $_POST["message"];
    $date = $_POST["date"];
    $time = $_POST["time"];

    $query = "INSERT INTO feedback (name, email, feedback_message, feedback_date, feedback_time) 
              VALUES ('$name', '$email', '$msg', '$date', '$time')";
    mysqli_query($connect, $query);

    mysqli_close($connect);
    ?>
        
    <script type="text/javascript">
      alert("<?php echo $name . ' Your feedback has been successfully submitted. We will get back to you via email.'?>");
    </script>
        
    <?php
    echo '<meta http-equiv="refresh" content="0;URL=contact_us.php">';
  }
?>
