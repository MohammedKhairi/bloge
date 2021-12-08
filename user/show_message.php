<?php
    //////////all data //////////////
    

    //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
    session_start();
    if(isset($_SESSION['name'],$_SESSION['u_id']))
    {
        include_once('../database/config.php');
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        include_once('../database/message_model.php');
        //echo $_SESSION['name'].'u'.$_SESSION['u_id'];

        $message=get_user_message($conn,$_SESSION['u_id']);
    }
    else
    {
        //header('Location: '.'login.php');
       // exit;
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<style>
    .content_left{
        width:30%;
        background:#bd5d37;
        padding-bottom: 50px;
        float:left;
    }
    .content_right{
        width:70%;
        background:#fff;
        float:right;

    }
    p.p_comm 
    {
    font-family: tahoma;
    font-size: 14px;
    background: #343a40;
    color: #fff;
    width: 90%;
    padding: 10px 5px;
    border-radius: 5px;
    }
    .img_user 
    {
    width: 80%;
    height: 220px;
    margin: auto;
    }
    .work_user 
    {
    width: 80%;
    margin: auto;
    }
    img.slid{
    width: 150px;
    height: 160px;
    position: relative;
    margin: auto;
    float: none;
    display: flex;
    top: 15%;
    border-radius: 50%;
    border: 5px solid #af3607;
    }
    .work_user ul {
    margin: auto;
    float: none;
    list-style: none;
    text-align: center;
    margin-right: 34px;
    }
    .work_user ul li {
        display: block;
        padding: 15px 0px;
    }
    .work_user ul li a {
        color: #e0e0e0;
        font-size: 15px;
        font-weight: bolder;
        font-family: 'El Messiri', sans-serif;
        text-decoration: none;
    }
    .content_right_all {
        position: relative;
        width: 90%;
        height: 100%;
        margin: auto;
    }
    /* .work_user ul li:hover,a:hover
    {
        background:#e0e0e0;
        color:#bd5d37;
    }
    .work_user ul li a:hover
    {
        color:#bd5d37;
    } */
    h5
    {
        text-align: center;
        font-weight: bold;
        font-size: 11px;
        font-family: 'El Messiri', sans-serif;
        margin-bottom: 1px;
    }
    .mulimedia ul
    {
        background: #312e2e;
        margin: auto;
        height: 40px;
        line-height: 40px;
    }

    .mulimedia ul li
    {
    display: inline-block;
    list-style: none;
    padding: 7px;
    }
    .mulimedia ul li i
    {
        color: #fff;
        cursor: pointer;
    }
    .card
    {
        width:50%;
        float:none;
        margin:auto;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }
    .card_content
    {
        width:98%;
        height:100%;
        float:none;
        margin:auto;
    }
    .card_img
    {
        width:100%;
        height:230px;
    }
    .card_img img {
        width: 60%;
        height: 100%;
        display: flex;
        float: none;
        margin: auto;
        border-radius: none;  
    }
    .info_u ul {
        margin: auto;
        float: none;
        list-style: none;
        text-align: center;
        margin-right: 34px;
    }
    .info_u ul li {
        display: block;
        padding: 15px 0px;
        color: #312e2e;
        font-size: 15px;
        font-weight: bolder;
        font-family: 'El Messiri', sans-serif;
        text-decoration: none;
        direction: rtl; 
    }
    img.img_table {
        width: 120px;
        height: 80px;
    }
    table
    {
        font-family:'El Messiri', sans-serif;
        text-align:center;

    }
    label
    {
        font-family:'El Messiri', sans-serif;
        float:right;
    }
    th
    {
        text-align:center;
    }
</style>

<body>
<div class="container">
    <div style="width:100%;height:30px;background:#312e2e;"></div>
    <div class="all_content"  style="border-top:3px solid red;box-shadow: 0 0px 8px 0 rgba(0, 0, 0, 0.2);">
        <div class="content_left">
            <br>
                <div class="mulimedia">
                    <ul>

                    <a style="padding: 10px;margin: 0px 30px;text-decoration: none;font-family:'El Messiri', sans-serif;font-weight: bolder;color: #bd5d37;" href="logout.php">Log Out</a>
                    <a style="padding: 10px;margin: 0px 30px;text-decoration: none;font-family:'El Messiri', sans-serif;font-weight: bolder;color: #bd5d37;" href="../index.php">Website</a>
                    </ul>
                </div>
            <br>
            <div class="img_user">

                <img class="slid" src="../img/user/user.png"/>

            </div>
 
             <h5 style="">
             <?=$_SESSION['name']?>

             </h5>
             <h5 style="">
             <?= $_SESSION['email']; ?>
             </h5>
             <br>
             <div class="work_user">
                 <ul>
                     <li><a href="profile.php">Profile Info</a></li>
                     <li><a href="profile_edit.php">Edit Profile</a></li>
                     <li><a href="show_message.php">Show Message</a></li>

                 </ul>
             </div>
        </div>
        <div class="content_right">
            <br><br><br>
<!-- ######################### -->

<div class="content_right_all">
     <?php
     if(isset($message))
     {
         if($message->num_rows>0)
         {
             
            while($row=$message->fetch_assoc())
            {

                echo '<p class="p_comm"> <span style="color:#ee4266;">Name : </span>'.$row["m_name"].'  <span style="color:#ee4266;">Date : </span>'.date('M d,Y',strtotime($row["m_date"])).' <span style="color:#ee4266;">Content : </span>'.mb_strcut($row["m_content"],0,100,"UTF-8"). '</p>';
                
                $replay=get_user_message_replay($conn,$row['m_id']);
                if($replay->num_rows>0)
                {
                    while($rep=$replay->fetch_assoc())
                    {
                       echo '<p class="p_comm"> <span style="color:#28a745;">Admin : </span>Admin <span style="color:#28a745;">Date : </span>'.date('M d,Y',strtotime($rep["rm_date"])).' <span style="color:#28a745;">Content : </span>'.$rep["rm_content"]. '</p>';
                    }

                }
                else
                {
                    echo 'No Replay';
                }

            
            }
         }
         else
         {
         echo 'No message';
         }

     }
     $conn->close();

?>
</div>
<!-- ################################ -->


</div>
<br>
        <footer style="width:100%;height:70px;background:#312e2e;display: flex;">
            
            <p  style="float: none;color: #fff; text-align: center; margin: auto;font-family: tahoma">© Copyright 2020 Iraqi Orphan Foundation && Admin templat | All Rights Reserved for Designer With  <i class="fa fa-heart-o" style="color:red;margin-left: 10px;" aria-hidden="true"> </i> </p>
        </footer>
    </div>
    
</div>
    
</body>
</html>