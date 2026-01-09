<?php
    include("dbconnection.php");
    session_start();

    $admin_Id = $_SESSION['adminID'];
    $admin_name = $_SESSION['adminName'];

    if(!isset($admin_Id) && !isset($admin_name))
    {
        ?>
        <script>
            alert("Please login first !");
            window.location.href="login.php";
        </script>
        <?php
    }
?>