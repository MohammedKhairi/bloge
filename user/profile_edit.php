<?php
    //////////all data //////////////
    include_once('../database/config.php');
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    include_once('../database/user_model.php');

    //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
    session_start();
    if(isset($_SESSION['uname'],$_SESSION['upass']))
    {
        
        $check=check_user_login($conn,$_SESSION['uname'],$_SESSION['upass']);
        $conn->close();
        if(!$check)
            {
                
                header('Location: '.'login.php');  
            }
            //echo'ok';exit;
    }
    else
    {
        header('Location: '.'login.php');
        exit;
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
    float:left;
    font-weight: bold;
    margin-bottom: 10px;
}
th
{
    text-align:center;
}
th.th_center {
    padding: 12px;
}
thead.thead-dark {
    background: #343a40;
    color: #fff;
}
a.btn_chang {
    color: #bd5d37;
    cursor: pointer;
}
input.input
{
    width: 100%;
    height: 40px;
    padding: 0px 15px;
    background-color: #fff;
    border-radius: 2px;
    border: 2px solid #e8eaed;
}

.primary_button
{
    margin-top: 10px;
    background-color: #ee4266;
    color: #fff;
    -webkit-box-shadow: 0px 0px 0px 2px #ee4266 inset;
    box-shadow: 0px 0px 0px 2px #ee4266 inset;
}

.primary_button
{
    display: inline-block;
    padding: 10px 40px;
    border-radius: 2px;
    border: none;
    font-weight: 700;
    font-size: 14px;
    text-transform: uppercase;
    -webkit-transition: 0.2s all;
    transition: 0.2s all;
}

.primary_button:hover
{
    color: #ee4266;
    background-color: #fff;
    -webkit-box-shadow: 0px 0px 0px 2px #ee4266 inset;
    box-shadow: 0px 0px 0px 2px #ee4266 inset;
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
    <table class="table" style="width: 100%;" >
        <thead class="thead-dark">
        <tr>
            <th class="th_center">Your Name </th>
            <th class="td_center" id="th_height"><?= $_SESSION['name']; ?></th>
            <th><a class="btn_chang" onclick="name_u()"  role="button">Change</a>
        </tr>
        <tr>
            <th class="th_center">UserName </th>
            <th class="td_center" id="th_height"><?= $_SESSION['uname']; ?></th>
            <th><a class="btn_chang" onclick="uname_u()"  role="button">Change</a>
        </tr>
        <tr>
            <th class="th_center"> Password</th>
            <th class="td_center" id="th_height"><?= $_SESSION['upass']; ?></th>
            <th><a class="btn_chang" onclick="pass_u()"  role="button">Change</a>
        </tr>
        <tr>
            <th class="th_center">Email</th>
            <th class="td_center" id="th_height1"><?= $_SESSION['email']; ?></th>
            <th><a class="btn_chang" onclick="email_u()" role="button">Change</a>

        </tr>
        </thead>

        </table>
        <br>
        <p style="border-top:2px solid #6c757d;width:100%;display: flex;"></p>
    <div class="form_u" id="form_u">
        <?php 
            // عرض رسالة للمستخدم عند الخطا
        
            if(isset($_SESSION['update_error']))
            {
                echo '<p style="background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
                '.$_SESSION['update_error'].
                '</p>';  
                unset($_SESSION['update_error']);     
                
            }
                            
        ?>
            
    </div>
</div>
<script type='text/javascript' src="../js/form_edit_info.js"></script>

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