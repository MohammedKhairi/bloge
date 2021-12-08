<?php 
    //////////all data //////////////
    include_once('../database/config.php');
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
    if(isset($_POST['submit']))
    {
        include_once('../database/post_model.php');
        include_once('../database/comment_model.php');
        if(isset($_POST['p'],$_POST['name'],$_POST['content']))
        {
            $p_id= strip_tags($_POST['p']);
            $name=strip_tags($_POST['name']);
            $content=strip_tags($_POST['content']);
            //echo 'id  '.$p_id.'  c '.$content;
            session_start();
            if( empty(str_replace(' ', '', $p_id))||empty(str_replace(' ', '', $name))||empty(str_replace(' ', '', $content)))
            {
                $_SESSION['comment_add']='Pless Full all Record';
                header('Location: '.'../post.php?p='.$p_id);  
               //echo'data in';
               exit; 
            }
            $check_post=check_post($conn,$p_id);
            if($check_post==0)
            {
                $_SESSION['comment_add']='Pless Full all Record';
                header('Location: '.'../post.php?p='.$p_id); 
                //echo'data in';
                exit; 
            }
            $check=insert_comment($conn,$p_id,$name,$content);
            if($check)
            {
                $_SESSION['comment_add']='thank you for comment we will Reply at soon';
                header('Location: '.'../post.php?p='.$p_id); 
                //echo'data in';
                exit; 
            }
            else
            {
                $_SESSION['comment_add']='some think wroing !';
                header('Location: '.'../post.php?p='.$p_id); 
                //echo'data in';
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