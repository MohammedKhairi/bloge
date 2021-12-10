
<?php include_once('../temp/header.php');?>
<?php
    if(isset($_POST['submit']))
    {
        if(isset($_POST['name']))
        {
            if($_POST['name']==NULL ||$_FILES['fileToUpload']['name'] == "" )
            {
                $_SESSION['edit_error'] = 'Pless full all Record';
            }
            else
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
                            $title=$_POST['name'];
                            $img=$_FILES['fileToUpload']['name'];
                            $add=add_category($conn,$title,$img);
                            $conn->close();
                            if($add)
                            {
                                include_once('../../include/bulid_f.php');
                                refresh('show.php',0);
                                exit;
                            }
                            else
                            {
                            $_SESSION['edit_error']="some think woring";
                            }
                    } 
                    else
                    {

                        $_SESSION['edit_error']="Sorry, there was an error uploading your file.";
                    }
                }

                
               
            }

        }
        else
        {
            //session_start();
            $_SESSION['edit_error'] = 'Pless full all Record';
        }
    }
?>
<?php 
    // عرض رسالة للمستخدم عند الخطا

    if(isset($_SESSION['edit_error']))
    {
        echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
        '.$_SESSION['edit_error'].
        '</p>';  
        unset($_SESSION['edit_error']);     
        
    }             
?>
<div class="details" style="grid-template-columns: repeat(1,1fr);">
<div class="recentorder">
    <div class="cardHeader">
        <h2>Add Category</h2>
        <div class="btn_c">
            <a href="show.php" class="btn"><ion-icon name="arrow-back"></ion-icon> Back</a>
        </div>
        
    </div>
    <br>
    <form action="" method="post" enctype="multipart/form-data">
        <label class="p_label" style="display: inline;">Category Title</label>
        <input type="text" placeholder="Enter Category Title" name="name" class="btn_input" >
        <br>
        <br>
        <br>
        <label class="p_label" style="display: inline;">Category Image</label>
        <input type="file" class="btn_input"style="line-height: 60px;" name="fileToUpload" id="fileToUpload">
        <br>
        <br>
        <br>
        <input type="submit"   name="submit" value="UPDATE" class="btn_submit">
    </form> 
</div>
<script type='text/javascript' src="../../js/panal_admin.js"></script>
<?php include_once('../temp/footer.php');?>