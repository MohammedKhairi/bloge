<?php
    //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
    session_start();
    if(isset($_SESSION['u_id']))
    {
        if(isset($_GET['type']))
        {
            if(!$_GET['type']==NULL)
            {
                if($_GET['type']=="name")
                {
                    if(!isset($_POST['name']))
                    {
                        $_SESSION['update_error']="pless full all record";
                        header('Location: '.'profile_edit.php');
                        exit;
                    }
                    if($_POST['name']==NULL)
                    {
                        $_SESSION['update_error']="pless full all record";
                        header('Location: '.'profile_edit.php');
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
                    include_once('../database/user_model.php');
                    $update=update_user_info($conn,'u_name',$_POST['name'],$_SESSION['u_id']);
                    $conn->close();
                    if($update)
                    {
                        $_SESSION['name']=$_POST['name'];
                        $_SESSION['update_error']="the ".$_GET['type']. "  is update to  ".$_POST['name'];
                        header('Location: '.'profile_edit.php');
                        exit;
                    }
                    else
                    {
                        $_SESSION['update_error']="some think worng!";
                        header('Location: '.'profile_edit.php');
                        exit;
                    }

                }
                else if($_GET['type']=="username")
                {
                    if(!isset($_POST['uname']))
                    {
                        $_SESSION['update_error']="pless full all record";
                        header('Location: '.'profile_edit.php');
                        exit;
                    }
                    if($_POST['uname']==NULL)
                    {
                        $_SESSION['update_error']="pless full all record";
                        header('Location: '.'profile_edit.php');
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
                    include_once('../database/user_model.php');
                    $check=check_user($conn,$_POST['uname']);
                    if($check)
                    {
                        $_SESSION['update_error']="this Username is used Pless take anthor UserName";
                        header('Location: '.'profile_edit.php');
                        exit;
                    }
                    $update=update_user_info($conn,'u_username',$_POST['uname'],$_SESSION['u_id']);
                    $conn->close();
                    if($update)
                    {
                        $_SESSION['uname']=$_POST['uname'];
                        $_SESSION['update_error']="the ".$_GET['type']. "  is update to  ".$_POST['uname'];
                        header('Location: '.'profile_edit.php');
                        exit;
                    }
                    else
                    {
                        $_SESSION['update_error']="some think worng!";
                        header('Location: '.'profile_edit.php');
                        exit;
                    }

                }
                else if($_GET['type']=="password")
                {
                    if(!isset($_POST['upass']))
                    {
                        $_SESSION['update_error']="pless full all record";
                        header('Location: '.'profile_edit.php');
                        exit;
                    }
                    if($_POST['upass']==NULL)
                    {
                        $_SESSION['update_error']="pless full all record";
                        header('Location: '.'profile_edit.php');
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
                    include_once('../database/user_model.php');
                    $update=update_user_info($conn,'u_password',$_POST['upass'],$_SESSION['u_id']);
                    $conn->close();
                    if($update)
                    {
                        $_SESSION['uname']=$_POST['upass'];
                        $_SESSION['update_error']="the ".$_GET['type']. "  is update to  ".$_POST['upass'];
                        header('Location: '.'profile_edit.php');
                        exit;
                    }
                    else
                    {
                        $_SESSION['update_error']="some think worng!";
                        header('Location: '.'profile_edit.php');
                        exit;
                    }

                }
                else if($_GET['type']=="email")
                {
                     //echo 'email';exit;
                    if(!isset($_POST['email']))
                    {
                        $_SESSION['update_error']="pless full all record";
                        header('Location: '.'profile_edit.php');
                        exit;
                    }
                    if($_POST['email']==NULL)
                    {
                        $_SESSION['update_error']="pless full all record";
                        header('Location: '.'profile_edit.php');
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
                    include_once('../database/user_model.php');
                    $update=update_user_info($conn,'u_email',$_POST['email'],$_SESSION['u_id']);
                    $conn->close();
                    if($update)
                    {
                        $_SESSION['email']=$_POST['email'];
                        $_SESSION['update_error']="the ".$_GET['type']. "  is update to  ".$_POST['email'];
                        header('Location: '.'profile_edit.php');
                        exit;
                    }
                    else
                    {
                        $_SESSION['update_error']="some think worng!";
                        header('Location: '.'profile_edit.php');
                        exit;
                    }

                }
                else
                {

                    $_SESSION['update_error']="some think worng!";
                    header('Location: '.'profile_edit.php');
                    exit;
                }

            }
            else
            {
                $_SESSION['update_error']="pless full all record";
                header('Location: '.'profile_edit.php');
                exit;
            }

        }
        else
        {
            header('Location: '.'profile_edit.php');
            exit;
        }
        
    }
    else
    {
        header('Location: '.'login.php');
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

    

?>