<?php

    session_start();
    if(isset($_SESSION['uname'],$_SESSION['upass']))
    {
        include_once('../database/config.php');
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        include_once('../database/user_model.php');
        
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
    font-family:sans-serif;
    text-decoration: none;
    direction: ltr;
    text-align: center;
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
.multi_a
{
    padding: 10px;margin: 0px 30px;text-decoration: none;font-family:'El Messiri', sans-serif;font-weight: bolder;color: #bd5d37;
}
.mulimedia {
    width: 100%;
}
@media only screen and (max-width: 850px)
{   
    
    .multi_a
{text-align: center;}
    .card 
    {
     width: 100%;
    }
    .info_u ul
    {
        padding: 0px;
    width: 100%;
    }
    .mulimedia ul
     {
    height: auto;
    line-height: 30px;
    width: 100%;
    padding: 0px;
    /* float: left; */
    }
    .multi_a 
    {
    display: block;
    padding:0px;
    margin:0px;
    }
    .img_user
     {
    height: 120px;
    }
    img.slid 
    {
    width: 100%;
    height: 100%;
    }
    h5 
    {
    width:95%;
    font-size: 10px;
    font-family: sans-serif;
    }
    .work_user ul
    {
        width:100%;
        padding: 0px;
    }
    .info_u ul li 
    {
        font-size:12px;
    }


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

                    <a class="multi_a"  href="logout.php">Log Out</a>
                    <a class="multi_a"  href="../index.php">Website</a>
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
                  <div class="card">
                       <div class="card_content">
                             <div class="card_img">

                              <img src="../img/user/user.png"/>
                             </div>
                             <div class="info_u">
                                <ul>
                                    <li>
                                        Name: <?=$_SESSION['name']; ?>
                                    </li>
                                    <li>
                                        UserName: <?=$_SESSION['uname']; ?>
                                    </li>
                                    <li>
                                        Password <?=$_SESSION['upass']; ?>
                                    </li>
                                    <li>
                                        Email <?=$_SESSION['email']; ?>
                                    </li>
                                    
                                </ul>
                             </div>
                             
                       </div>
                  </div>
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