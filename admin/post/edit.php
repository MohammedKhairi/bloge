<?php
if(isset($_POST['submit']))
   {
       //echo$_POST['name'];exit;
       // update category name
       if(isset($_GET['p'],$_GET['p_type']))
       {
           // echo'yes';exit;

            include_once('../../database/config.php');
            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
            }
            include_once('../../database/post_model.php');
            //title
            if($_GET['p_type']=="title")
            {
                if($_POST['title']=="")
                {
                    $_SESSION['edit_error']="some think error";
                    header('Location: '.'update.php?type=edit&p='.$_GET['p']);
                    exit;
                }
                $record="p_title";
                $value=$_POST['title'];
                $check_n=update_record($conn,$record,$value,$_GET['p']);
                $conn->close();
                include_once('../../include/bulid_f.php');
                if($check_n==1)
                {
                    refresh('show.php',0);
                    exit;
                }
                else
                {
                    $_SESSION['edit_p_error']="some think error";
                    header('Location: '.'update.php?type=edit&p='.$_GET['p']);
                    exit;
            
                }
            }
            //content
            else if($_GET['p_type']=="content")
            {
                if($_POST['content']=="")
                {
                    $_SESSION['edit_error']="some think error";
                    header('Location: '.'update.php?type=edit&p='.$_GET['p']);
                    exit;
                }
                $record="p_content";
                $value=$_POST['content'];
                $check_n=update_record($conn,$record,$value,$_GET['p']);
                $conn->close();
                include_once('../../include/bulid_f.php');
                if($check_n==1)
                {
                    refresh('show.php',0);
                    exit;
                }
                else
                {
                    $_SESSION['edit_p_error']="some think error";
                    header('Location: '.'uodate.php?type=edit&p='.$_GET['p']);
                    exit;
            
                }
            }
            //category
            else if($_GET['p_type']=="category")
            {
                if($_POST['category']=="")
                {
                    $_SESSION['edit_error']="some think error";
                    header('Location: '.'update.php?type=edit&p='.$_GET['p']);
                    exit;
                }
                $record="p_c_id";
                $value=$_POST['category'];
                $check_n=update_record($conn,$record,$value,$_GET['p']);
                $conn->close();
                include_once('../../include/bulid_f.php');
                if($check_n==1)
                {
                    refresh('show.php',0);
                    exit;
                }
                else
                {
                    $_SESSION['edit_p_error']="some think error";
                    header('Location: '.'uodate.php?type=edit&p='.$_GET['p']);
                    exit;
            
                }
            }
            //tage
            else if($_GET['p_type']=="tagg")
            {
                if($_POST['tagess']=="")
                {
                    $_SESSION['edit_error']="some think error";
                    header('Location: '.'update.php?type=edit&p='.$_GET['p']);
                    exit;
                }
                $record="p_tags";
                $value=$_POST['tagess'];
                ///echo $value;exit;
                $check_n=update_record($conn,$record,$value,$_GET['p']);
                $conn->close();
                include_once('../../include/bulid_f.php');
                if($check_n==1)
                {
                    refresh('show.php',0);
                    exit;
                }
                else
                {
                    $_SESSION['edit_p_error']="some think error";
                    header('Location: '.'uodate.php?type=edit&p='.$_GET['p']);
                    exit;
            
                }
            }
            elseif($_GET['p_type']=="p_p_img")
            {
                if($_FILES['fileToUpload']['name'] == "")
                {
                    $_SESSION['edit_error']="some think error";
                    header('Location: '.'update.php?type=edit&p='.$_GET['p']);
                    exit;
                }
                
                //file check
                $target_dir = "../../img/posts/";
                $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
                // Check if image file is a actual image or fake image
                // No file was selected for upload, your (re)action goes here   
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if($check !== false)
                {
                    $uploadOk = 1;
                }
                // Check if file already exists
                else if (file_exists($target_file))
                {
                    $_SESSION['edit_error']="Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                else if ($_FILES["fileToUpload"]["size"] > 500000)
                {
                    $_SESSION['edit_error']="Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" )
                {         
                    $_SESSION['edit_error']="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                //echo 'no';exit;
                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0)
                {
                    //echo 'no';exit;
                    $_SESSION['edit_error']="Sorry, your file was not uploaded.";
                    header('Location: '.'update.php?type=edit&p='.$_GET['p']);
                    exit;
                    // if everything is ok, try to upload file
                } 
                else 
                {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
                        {
                            // Check connection
                                include_once('../../database/config.php');
                                if ($conn->connect_error) 
                                {
                                    die("Connection failed: " . $conn->connect_error);
                                }
                                include_once('../../database/post_model.php');
                                ///delete old image 
                                $delete=delete_image_post($conn,$_GET['p']);
                                if(!$delete)
                                {
                                 // echo 'no d';exit;

                                    $_SESSION['edit_error']="Sorry, there was an error can not delete old img";
                                    header('Location: '.'update.php?type=edit&p='.$_GET['p']);
                                    exit;
                                }
                            // echo 'in u';exit;
                            $img=$_FILES['fileToUpload']['name'];
                            $filename=$target_file.$img;
                            $edit=update_record($conn,'p_img',$img,$_GET['p']);
                            $conn->close();
                            if($edit)
                            {
                                include_once('../../include/bulid_f.php');
                                refresh('show.php',0);
                                exit;
                            }
                            else
                            {
                               // echo $filename;
                               // unlink($filename);
                                $_SESSION['edit_error']="some think woring";
                                header('Location: '.'update.php?type=edit&p='.$_GET['p']);
                                exit;
                            }
                    } 
                    else
                    {
                        //echo 'no u';exit;
                        $_SESSION['edit_error']="Sorry, there was an error uploading your file.";
                        header('Location: '.'update.php?type=edit&p='.$_GET['p']);
                        exit;
            
                    }
                }
            }
            //error
            else
            {
                $_SESSION['edit_error']="some think error";
                header('Location: '.'uodate.php?type=edit&p='.$_GET['p']);
                exit;
           
            }
       }
       else
       {
        $_SESSION['edit_p_error']="Pless Full Category Name Record";
        header('Location: '.'update.php?type=edit&p='.$_GET['p']);
        exit;
       }
    }
    else
    {
     $_SESSION['edit_p_error']="Pless Full Category Name Record";
     header('Location: '.'update.php?type=edit&p='.$_GET['p']);
     exit;
    }

?>