<?php
    session_start();

    if(isset($_SESSION['u_id']))
    {
        header('Location: '.'../index.php'); 
        exit;
    }
    //////////all data //////////////
    include_once('../database/config.php');
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    include_once('../database/user_model.php');

    //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
if(isset($_POST['submit']))
{
    if(isset($_POST['name'],$_POST['username'],$_POST['password'],$_POST['email']))
    {
        if($_POST['name']==NULL||$_POST['username']==NULL||$_POST['password']==NULL||$_POST['email']==NULL)
        {
            $_SESSION['register_error'] = 'Pless full all record';
            header('Location: '.'register.php'); 
            exit;
        }
        else
        {
        
           $check=check_user($conn,$_POST['username']);
           if($check)
           {
            $_SESSION['register_error'] = 'This UserName is Used Pless take anthoer Username ';
            header('Location: '.'register.php'); 
            exit;
           }
           else
           {
            $name=strip_tags($_POST['name']) ;
            $username=strip_tags($_POST['username']) ;
            $password=strip_tags($_POST['password']) ;
            $email=strip_tags($_POST['email']) ;
           // echo'n'.$name.'un'.$username.'p'.$password.'e'.$email;exit;
            $insert=insert_user($conn,$name,$username,$password,$email);
            if($insert)
            {
                //echo 'yes';exit;
                $user=user_info($conn,$username,$password);
                $user_info=$user->fetch_assoc();
               // session_start();
                $_SESSION['u_id'] = $user_info['u_id'];
                $_SESSION['name'] = $user_info['u_name'];
                $_SESSION['uname'] = $user_info['u_username'];
                $_SESSION['upass'] = $user_info['u_password'];
                $_SESSION['email'] = $user_info['u_email'];
                //$_SESSION['register_error'] = 'You Are REGISTERED  Successfuly Wellcome ';
                header('Location: '.'../index.php'); 
                exit;
            }
            else
            {
                $_SESSION['register_error'] = 'some think wrong!';
                header('Location: '.'register.php'); 
                exit;

            }
         }
        }
    }
    else
    {
        $_SESSION['register_error'] = 'Pless full all record';
            header('Location: '.'register.php'); 
            exit; 

    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register form</title>
</head>

<style>
    body
    {
        margin: 0;
        display: flex;
        padding: 0px;

    }
    .bg_model
    {
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        position: absolute;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: auto;
    }

    .model_content
    {
        width: 50%;
        height: 550px;
        background: #ffffff;
        border-radius: 5px;
        position: relative;
        box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.6);
    }
    .close
    {
        position: absolute;
        top: 0;
        right: 14px;
        font-size: 36px;
        color: black;
        transform: rotate(45deg);
        cursor: pointer;
        font-weight: bold;
        transition: 500ms all;
        
    }


    .close:hover
    {
        
        transform: rotate(-45deg);
        color: #37f;  
        
    }
    p.title
    {
        display: block;
        margin:  auto;
        width: 60%;
        text-align: center;
        font-family: tahoma;
        font-size: 1.8vw;
        color: rgb(179, 0, 0);
    }
    input.btn_input ,.btn_submit
    {
        display: block;
        margin:  auto;
        padding:  10px 10px;
        width: 60%;
    }
    input.btn_submit:hover
    {
        color: rgb(179, 0, 0);
        transition: 400ms all;
        background: linear-gradient(to bottom, #33ccff 0%, #ff99cc 100%);
    }
    input.btn_submit
    {
        width:30%;
        border: none;
        /* border: 2px solid rgb(179, 0, 0); */
        padding:  9px 9px;
        border-radius:7px;
        background: linear-gradient(to bottom, #33ccff 0%, #3366ff 100%);
        font-family: tahoma;
        color: #ffffff;
        letter-spacing: 2px;
        font-size: 1vw;
    }

    a.back_h {
        text-align: center;
        background: #ee4266;
        color: #fff;
        font-weight: bold;
        padding: 20px;
        text-decoration: none;
        font-family: tahoma;
        margin-top: 10px;
        margin-left: 10px;
        border-radius: 20px;
    }
    .rec {
        width: 40px;
        height: 40px;
        display: flex;
        transform: rotate(45deg);
        background: #ee4266;
        float: left;
        margin-top: -11px;
        margin-left: 20px;
        margin-right: -22px;
    }

</style>
<body>
    <div style="  margin-top: 50px;">
    <div class="rec">
    </div>
    <a  class="back_h"href="../index.php"> Back to Home Page</a>
    
    

    </div>
    <div class="bg_model">
        <div class="model_content">
            <div class="close" title="Close Overlay">+</div>
            <br>
            <br>
            <br>
            <p class="title">REGISTER FORM</p>
            <br>
            <?php 
                // عرض رسالة للمستخدم عند الخطا
            
                if(isset($_SESSION['register_error']))
                {
                    echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
                    '.$_SESSION['register_error'].
                    '</p>';  
                    unset($_SESSION['register_error']);     
                    
                }
                                
            ?>
            <br>
            <br>
                <form action="" method="post">
                    <input type="text"name="name" class="btn_input" placeholder="Enter Your Name ">
                    <br><br>
                    <input type="text"name="username" class="btn_input" placeholder="Enter Your User Name">
                    <br><br>
                    <input type="password"name="password" class="btn_input"placeholder="Enter Your password">
                    <br><br>
                    <input type="email"name="email" class="btn_input"placeholder="Enter Your Email">
                    <br><br>
                    <input type="submit" name="submit" value="Register" class="btn_submit">
                </form>
        </div>

    </div>

    <script type="text/javascript">
       document.querySelector('.close').addEventListener('click',function(){

           document.querySelector('.bg_model').style.display='none';
       });
    
    </script>
</body>
</html>