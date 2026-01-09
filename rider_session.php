<?php
    include("dbconnection.php");
    session_start();

    $rider_id = $_SESSION['riderID'];
    $rider_name = $_SESSION['riderName'];

    if(!isset($rider_id) && !isset($rider_name))
    {
        ?>
        <script>
            alert("Please login first !");
            window.location.href="login.php";
        </script>
        <?php
    }
?>