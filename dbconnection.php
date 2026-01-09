<?php

$connect= mysqli_connect("localhost","root","","pizz_pizza");// fill out database name
if ($connect->connect_error) 
{
    die("Connection failed: " . $connect->connect_error);
}
//this is the temporary connection, later need to do check login first like staff_session.php in iwp project
?>