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
    <link rel="stylesheet" href="../css/user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>


<body>
<div class="container">
    <div style="width:100%;height:30px;background:#312e2e;"></div>
    <div class="all_content"  style="border-top:3px solid red;box-shadow: 0 0px 8px 0 rgba(0, 0, 0, 0.2);">
    <div class="content_left">

<div class="site-option">
    <li><a href="logout.php">Log Out</a></li>
    <li><a href="../index.php">Website</a></li> 
</div>

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
    <table>
            <tbody>
        <tr>
            <td class="th_center">Your Name </td>
            <td class="td_center" id="th_height"><?= $_SESSION['name']; ?></td>
            <td>
                <a><span class="status return" onclick="name_u()" role="button">Change</span></a>
            </td>
        </tr>
        <tr>
            <td class="th_center">UserName </td>
            <td class="td_center" id="th_height"><?= md5($_SESSION['uname']);?></td>
            <td>
                <a><span class="status return" onclick="uname_u()" role="button">Change</span></a>
            </td>
        </tr>
        <tr>
            <td class="th_center"> Password</th>
            <td class="td_center" id="th_height"><?= md5($_SESSION['upass']); ?></td>
            <td>
                <a><span class="status return" onclick="pass_u()" role="button">Change</span></a>
            </td>
        </tr>
        <tr>
            <td class="th_center">Email</th>
            <td class="td_center" id="th_height1"><?= $_SESSION['email']; ?></td>
            <td><a><span class="status return" onclick="email_u()" role="button">Change</span></a></td>
            

        </tr>
            </tbody>
    </table>

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
            
            <p  style="float: none;color: #fff; text-align: center; margin: auto;font-family: tahoma">   Copyright ©   2019 All rights of design are Reserved Mohaemed Khairi with  <i class="fa fa-heart-o" style="color:red;margin-left: 10px;" aria-hidden="true"> </i> </p>
        </footer>
    </div>
    
</div>
    
</body>
</html>