<?php
 session_start();
if(isset($_SESSION['ustate']))
{
    header('Location: '.'admin/info/dashboard.php'); 
    exit;
}
if(isset($_POST['submit']))
{
    //echo'yes';exit;
    if(isset($_POST['username'],$_POST['password']))
    {
        if($_POST['username']==NULL||$_POST['password']==NULL)
        {
            $_SESSION['login_admin_error'] = 'Pless full all record';
        }
        else
        {
                //////////all data //////////////
            include_once('database/config.php');
            // Check connection
            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
            }
            include_once('database/admin_model.php');

            //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
            $username=strip_tags($_POST['username']) ;
            $password=strip_tags($_POST['password']) ;
            $check=check_admin_login($conn,$username,$password);
            if($check)
            {
                //session_start();
                $admin=admin_info($conn,$username,$password);
                $admin_info=$admin->fetch_assoc();
                $conn->close();
                //echo'u  '.$user_info['u_name'].'  p'.$user_info['u_password'];
                //echo'  us  '.$user_info['u_username'].'  e'.$user_info['u_email'];exit;
                 // Initializing Session
                session_start();
                $_SESSION['u_id'] = $admin_info['u_id'];
                $_SESSION['name'] = $admin_info['u_name'];
                $_SESSION['uname'] = $admin_info['u_username'];
                $_SESSION['upass'] = $admin_info['u_password'];
                $_SESSION['email'] = $admin_info['u_email'];
                $_SESSION['ustate'] = $admin_info['u_state'];
                //echo $_SESSION['name'];exit;
                header("location:"."admin/info/dashboard.php"); // Redirecting To Other Page
                exit;
            }
            else
            {
                $conn->close();
                $_SESSION['login_admin_error'] = 'Username Or Password false !';

            }
         
        }
    }
    else
    {   

         $_SESSION['login_admin_error'] = 'some think worng !';

    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin form</title>
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
        height: 400px;
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

</style>
<body>
    <div class="bg_model">
        <div class="model_content">
            <br>
            <br>
            <p class="title">ADMIN LOG IN FORM</p>
            <br>
            <?php 
                // عرض رسالة للمستخدم عند الخطا
            
                if(isset($_SESSION['login_admin_error']))
                {
                    echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
                    '.$_SESSION['login_admin_error'].
                    '</p>';  
                    unset($_SESSION['login_admin_error']);     
                    
                }
                                
            ?>
            <br>
            <br>
                <form action="" method="post">
                    <input type="text" name="username" class="btn_input" placeholder="Enter Your User Name">
                    <br><br>
                    <input type="password" name="password" class="btn_input"placeholder="Enter Your password">
                    <br><br>
                    <input type="submit" name="submit" value="LOG IN" class="btn_submit">
                </form>
           
             
        </div>

    </div>
</body>
</html>