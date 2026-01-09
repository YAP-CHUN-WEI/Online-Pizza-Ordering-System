<?php
    session_start();
    include("dbconnection.php");
    
    session_destroy();
    echo "<script>alert('Logout sucessfully !');</script>";
    header("refresh: 0.2; url = Main.php");
?>