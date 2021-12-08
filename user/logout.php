<?php
session_start();
if(isset($_SESSION['email'],$_SESSION['upass'],$_SESSION['uname'],$_SESSION['name'],$_SESSION['u_id']))
{
    unset($_SESSION['uname']);
    unset($_SESSION['upass']);
    unset($_SESSION['email']);
    unset($_SESSION['name']);
    session_destroy();
    header("location:"."../index.php"); 
    exit();
}
else
{
    header("location:"."../index.php"); 
    exit();
}
 

 ?>