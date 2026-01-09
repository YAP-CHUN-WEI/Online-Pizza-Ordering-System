<?php
    include("dbconnection.php");
    session_start();
    
    $user_email = $_SESSION["email"];
    $user_pass = $_SESSION["pass"];
    $user_id = $_SESSION["uid"];

    if(!isset($user_email) && !isset($user_pass))
    {
        ?>
        <script>
            alert("Please login first !");
            window.location.href="login.php";
        </script>
        <?php
    }
?>