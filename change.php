<?php 
    $query = $_POST['query'];
    session_start();
    $_SESSION['w_mode']=$query;
    //echo 'ok'. $_SESSION['w_mode'];


?>
