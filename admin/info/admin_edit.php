<?php include_once('../template/header.php');?>
<?php

if(isset($_POST['submit']))
{
    //echo'yes';exit;
    if(isset($_POST['name']))
    {
        if($_POST['name']==NULL)
        {
            $_SESSION['info_admin_error'] = 'name record';
        }
        else
       {
           //////////all data //////////////
           include_once('../../database/config.php');
           // Check connection
           if ($conn->connect_error) 
           {
               die("Connection failed: " . $conn->connect_error);
           }
           include_once('../../database/admin_model.php');
           //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
           $name=strip_tags($_POST['name']) ;
           $check=update_user_info($conn,'u_name',$name,$_SESSION['u_id']);
           $conn->close();
           if(!$check)
           {
               $_SESSION['info_admin_error'] = 'some think wrong!';
           }
           else
           {
            $_SESSION['info_admin_error'] = 'the Name Record is Updated';
            $_SESSION['name'] = $name;
           }
          
       }
    }
    else if(isset($_POST['username']))
    {
       if( $_POST['username']==NULL)
       {
        $_SESSION['info_admin_error'] = 'Pless Username record';

       }
       else
       {
           //////////all data //////////////
           include_once('../../database/config.php');
           // Check connection
           if ($conn->connect_error) 
           {
               die("Connection failed: " . $conn->connect_error);
           }
           include_once('../../database/admin_model.php');
           //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
           $username=strip_tags($_POST['username']) ;
           $check1=check_admin_username($conn,$username);
           if($check1)
           {
               $_SESSION['info_admin_error'] = 'this UserName is Used Pless take anthor Username ';

           }
           else
           {
                $check=update_user_info($conn,'u_username',$username,$_SESSION['u_id']);
                $conn->close();
                if(!$check)
                {
                    $_SESSION['info_admin_error'] = 'some think wrong!';
                }
                else
                {
                    $_SESSION['info_admin_error'] = 'the Username Record is Updated';
                    $_SESSION['uname'] = $username;
                }
                

           }
           

       }
    }
    else if(isset($_POST['password']))
    {
        if($_POST['password']==NULL)
        {
            $_SESSION['info_admin_error'] = 'Pless Password record';
        }
        else
        {
            //////////all data //////////////
            include_once('../../database/config.php');
            // Check connection
            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
            }
            include_once('../../database/admin_model.php');
            //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
            $name=strip_tags($_POST['password']) ;
            $check=update_user_info($conn,'u_password',$name,$_SESSION['u_id']);
            $conn->close();
            if(!$check)
            {
                $_SESSION['info_admin_error'] = 'some think wrong!';
            }
            else
            {
             $_SESSION['info_admin_error'] = 'the Password Record is Updated';
             $_SESSION['upass'] = $name;
            }
           
        }
    }
    else if(isset($_POST['email']))
    {
       if($_POST['email']==NULL)
       {
            $_SESSION['info_admin_error'] = 'Pless email record';
       }
       else
       {
           //////////all data //////////////
           include_once('../../database/config.php');
           // Check connection
           if ($conn->connect_error) 
           {
               die("Connection failed: " . $conn->connect_error);
           }
           include_once('../../database/admin_model.php');
           //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
           $email=strip_tags($_POST['email']) ;
           $check=update_user_info($conn,'u_email',$email,$_SESSION['u_id']);
           $conn->close();
           if(!$check)
           {
               $_SESSION['info_admin_error'] = 'some think wrong!';
           }
           else
           {
            $_SESSION['info_admin_error'] = 'the Email Record is Updated';
            $_SESSION['email'] = $email;
           }
          
       }
    }
    else
    {   
        $_SESSION['info_admin_error'] = 'Pless full all record';  
    }
}


?>
<?php 
    // عرض رسالة للمستخدم عند الخطا

    if(isset($_SESSION['info_admin_error']))
    {
        echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
        '.$_SESSION['info_admin_error'].
        '</p>';  
        unset($_SESSION['info_admin_error']);     
        
    }
                    
?>
<br>
<br>
<form action="" method="post">
<label class="p_label">Name</label>

    <input type="text" value="<?=$_SESSION['name']?>" name="name" class="btn_input" >
    <input type="submit"  name="submit" value="UPDATE" class="btn_submit">
</form>
    <br><br>
<form action="" method="post">
<label class="p_label">Username</label>

    <input type="text" value="<?=$_SESSION['uname']?>"name="username" class="btn_input" >
    <input type="submit"  name="submit" value="UPDATE" class="btn_submit">
</form>
    <br><br>
<form action="" method="post">
    <label class="p_label">Password</label>
    <input type="password" value="<?=$_SESSION['upass']?>" name="password" class="btn_input">
    <input type="submit"  name="submit" value="UPDATE" class="btn_submit">
</form>
    <br><br>
<form action="" method="post">
<label class="p_label">Email</label>
    <input type="email" value="<?=$_SESSION['email']?>" name="email" class="btn_input" >
    <input type="submit"  name="submit" value="UPDATE" class="btn_submit">
</form> 
    <br><br>
<script type='text/javascript' src="../../js/panal_admin.js"></script>       
<?php include_once('../template/footer.php');?>
