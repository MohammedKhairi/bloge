<?php 
    session_start();
    if(!isset($_SESSION['u_id']))
    {
        header('Location: '.'../index.php');
        exit;
    }

    if(isset($_POST['submit']))
    {
        if(isset($_POST['name'],$_POST['content']))
        {
            
            $name=strip_tags($_POST['name']);
            $content=strip_tags($_POST['content']);
            $id=$_SESSION['u_id'];
            if(empty(str_replace(' ', '', $name))||empty(str_replace(' ', '', $content)))
            {
                session_start();
                $_SESSION['error_message'] = 'Pless Full all Record';
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
            //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
              include_once('../database/message_model.php');
            $check=insert_message($conn,$id,$name,$content);
            if($check)
            {
                
                $_SESSION['true_message'] = 'thank you we will back at soon in your account';
                header('Location: '.'../index.php');
                //echo'data in';
                exit;

            }
            else
            {
                session_start();
                $_SESSION['error_message'] = 'some think wrong';
                // data is not inserted
                header('Location: '.'../index.php');
                //echo'no data';
                exit;
            }
        }
        else
        {
            header('Location: '.'../index.php');  
            exit; 
        }
            
    }
    else
    {
        header('Location: '.'../index.php');  
        exit;
    }  
    $conn->close();
    //////////all data //////////////
?>