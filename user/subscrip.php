<?php 
    
    if(isset($_POST['submit']))
    {
        if(isset($_POST['email']))
        {  
            
            $email=strip_tags($_POST['email']);
            if($email==NULL)
            {
                session_start();
                $_SESSION['error_subscrip'] = 'pless Full Email Record';
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
            $test=check_email($conn,$email);
            if($test==1)
            {
                session_start();
                 $_SESSION['error_subscrip'] = 'You are already Subsribe in this Email';
               // echo 'data out';exit;
                header('Location: '.'../index.php');  
                exit; 
            }
            else
            {
               // echo 'data in';exit;
                $check=insert_subscrip($conn,$email);
                $conn->close();
                if($check)
                {
                    // data is inserted   
                    $to      = $email;
                    $subject = 'the subject';
                    $message = 'hello';
                    $headers = 'From: wee11175@gmail.com' . "\r\n" .
                        'Reply-To: wee11175@gmail.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();
                    mail($to, $subject, $message, $headers);
                    session_start();
                    $_SESSION['true_subscrip'] = 'Thank you for Subscribe we will send to you all Knew Post';
                   
                    header('Location: '.'../index.php');
                    //echo'data in';
                    exit;

                }
                else
                {
                    // data is not inserted
                   session_start();
                     $_SESSION['error_subscrip'] = 'some think worng!';
                    header('Location: '.'../index.php'. $_SESSION['message']);
                    //echo'no data';
                    exit;
                }

            }
            
        }
        else
        {
            session_start();
            $_SESSION['error_subscrip'] = 'pless Full Email Record';
            header('Location: '.'../index.php');  
            exit; 
        }
            
    }
    else
    {
        header('Location: '.'../index.php');  
        exit;
    }  
    
    //////////all data //////////////
?>