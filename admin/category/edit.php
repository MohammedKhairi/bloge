<?php
if(isset($_POST['submit']))
   {
       //echo$_POST['name'];exit;
       // update category name
       if(isset($_POST['name'])&&!empty(str_replace(' ', '', $_POST['name']))&&isset($_GET['cate']))
       {
           // echo'yes';exit;

            include_once('../../database/config.php');
            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
            }
            include_once('../../database/category_model.php');
            $name=$_POST['name'];
            $check_n=update_name($conn,$name,$_GET['cate']);
            $conn->close();
            include_once('../../include/bulid_f.php');
            if($check_n==1)
            {
                refresh('show.php',0);
                exit;
            }
            else
            {
                $_SESSION['name_error']="some think error with Update Category Name !";
                header('Location: '.'uodate.php?type=edit&cate='.$_GET['cate']);
                exit;
           
            }
       }
       ////update category img
       else if(!$_FILES['fileToUpload']['name'] == ""&&isset($_GET['cate']))
       {
             //file check
             $target_dir = "../../img/category/";
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
                 // echo 'no';exit;
                $_SESSION['edit_error']="Sorry, your file was not uploaded.";
                header('Location: '.'update.php?type=edit&cate='.$_GET['cate']);
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
                            include_once('../../database/category_model.php');
                            ///delete old image 
                            $delete=delete_image($conn,$_GET['cate']);
                            if(!$delete)
                            {
                            // echo 'no d';exit;

                                $_SESSION['edit_error']="Sorry, there was an error can not delete old img";
                                header('Location: '.'update.php?type=edit&cate='.$_GET['cate']);
                                exit;
                            }
                         // echo 'in u';exit;
                         $img=$_FILES['fileToUpload']['name'];
                         $edit=update_image($conn,$_GET['cate'],$img);
                         $conn->close();
                         if($edit)
                         {
                             include_once('../../include/bulid_f.php');
                             refresh('show.php',0);
                             exit;
                         }
                         else
                         {
                            $_SESSION['edit_error']="some think woring";
                            header('Location: '.'update.php?type=edit&cate='.$_GET['cate']);
                            exit;
                         }
                 } 
                 else
                 {
                    //echo 'no u';exit;
                    $_SESSION['edit_error']="Sorry, there was an error uploading your file.";
                    header('Location: '.'update.php?type=edit&cate='.$_GET['cate']);
                    exit;
        
                }
             }
        //end
       }
       else
       {
        $_SESSION['name_error']="Pless Full Category Name Record";
        header('Location: '.'update.php?type=edit&cate='.$_GET['cate']);
        exit;
       }
    }
    else
    {
     $_SESSION['name_error']="Pless Full Category Name Record";
     header('Location: '.'update.php?type=edit&cate='.$_GET['cate']);
     exit;
    }

?>