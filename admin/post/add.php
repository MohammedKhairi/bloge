



<?php include_once('../temp/header.php');?>

<?php
    if(isset($_POST['submit']))
    {
        if(isset($_POST['title'],$_POST['content'],$_POST['category'],$_POST['tagee']))
        {
            if($_POST['title']==NULL ||$_POST['content']==NULL ||$_POST['category']==NULL ||$_POST['tagee']==NULL ||$_FILES['fileToUpload']['name'] == "" )
            {
                $_SESSION['add_error'] = 'Pless full all Record';
            }
            else
            {
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
                    $_SESSION['add_error']="Sorry, file already exists.";
                    $uploadOk = 0;
                }
                // Check file size
                else if ($_FILES["fileToUpload"]["size"] > 500000)
                {
                    $_SESSION['add_error']="Sorry, your file is too large.";
                    $uploadOk = 0;
                }
                // Allow certain file formats
                else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"&& $imageFileType != "gif" )
                {         
                    $_SESSION['add_error']="Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }
                //echo 'no';exit;
                // Check if $uploadOk is set to 0 by an error
                 if ($uploadOk == 0)
                {
                    // echo 'no';exit;
                    $_SESSION['add_error']="Sorry, your file was not uploaded.";
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
                            include_once('../../database/message_model.php');
                            $title=$_POST['title'];
                            $content=$_POST['content'];
                            $category=$_POST['category'];
                            $tage=$_POST['tagee'];
                            $img=$_FILES['fileToUpload']['name'];
                            $add=add_post($conn,$title,$content,$category,$tage,$img);
                            if($add)
                            {
                                //send email for all subscriber 
                              $email=get_email_subscrip($conn);
                              $subject = 'New Post Add';
                                $message = $title;
                                $headers = 'From: wee11175@gmail.com' . "\r\n" .
                                    'Reply-To: wee11175@gmail.com' . "\r\n" .
                                    'X-Mailer: PHP/' . phpversion();
                              while($row_s = $email->fetch_assoc())
                              {
                                    // data is inserted   
                                    $to      = $row_s['s_email'];
                                    mail($to, $subject, $message, $headers);
                              }
                              $conn->close();
                                include_once('../../include/bulid_f.php');
                                refresh('show.php',0);
                                exit;
                            }
                            else
                            {
                            $conn->close();
                            $_SESSION['add_error']="some think woring";
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
            $_SESSION['add_error'] = 'Pless full all Record';
        }
    }
?>
<!-- ////////////[get add info cate tags for addd]////////////// -->
<?php 
    // Check connection
    include_once('../../database/config.php');
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    include_once('../../database/category_model.php');
    include_once('../../database/tags_model.php');
    //post data
    //category post
    $categories =select_all_categories($conn);
    // tags
    $tags=select_tags($conn);
    $conn->close();

    //////////all data //////////////
?>
<!--  Details List -->
<div class="details" style="grid-template-columns: repeat(1,1fr);" onload="enableediter();">
    <!-- order Details List -->
    <!-- ////////////[form error]////////////// -->

    <?php 
        // عرض رسالة للمستخدم عند الخطا

        if(isset($_SESSION['add_error']))
        {
        echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #000;">
        '.$_SESSION['add_error'].
        '</p>';  
        unset($_SESSION['add_error']);     

        }             
    ?>
    <div class="recentorder">
            <div class="cardHeader">
                <h2>Add Posts</h2>
                <div class="btn_c">
                    <a href="show.php" class="btn"><ion-icon name="arrow-back"></ion-icon> Back</a>
                </div>
            
            </div>
                <div class="cont_container">
                    <div class="cont_content">
                        <div class="right-side">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="input-box">
                                <input type="text" name="title" placeholder="Enter Post tite"/>
                            </div>
                            <br>
                            <div class="input-box">
                                <input type="text" name="category" id="b_value" placeholder="chose Category..." class="btn_input"  onclick="show_option()">
                                
                            </div>
                            <div class="option" id="list">
                                    <?php

                                        while($cate=$categories->fetch_assoc())
                                        {
                                        echo'
                                                <p onclick="get_value('.$cate["c_id"].')" class="p_o" value='.$cate["c_id"].'>
                                                    '. $cate["c_title"].'
                                                </p>
                                                <hr>
                                            ';
                                        }
                                    ?>
                                </div>
                            <br>
                            <div class="input-box" style="height: auto;">
                                <textarea name="content" id="editor" style="margin-top: 5px;height: 100px;display: inline;color: #ee4266;padding: 0px; margin-left: 5px;" class="input"  placeholder="Message.....">
                                </textarea>
                            </div>
                            <br>

                            <div class="input-box">
                                <input type="text" name="tagee" id="b_value2"  class="btn_input2" placeholder="chose Tage..." onclick="show_option2()">
                                
                            </div>
                            <div class="option2" id="list2">
                                    <?php

                                        while($tag=$tags->fetch_assoc())
                                        {
                                            $name='\''.$tag["t_name"].'\'';
                                        echo'
                                            <span class="s_list">'.$tag["t_name"].' </span>  <input type="checkbox" id="vehicle1" onclick="get_value2('.$name.')" class="p_o" name="tage" value="'.$tag["t_id"].'">

                                                <hr>
                                            ';
                                        }
                                    ?>
                            
                                </div>
                            <br>

                            <div class="input-box">
                                <input type="file" style="line-height: 3rem;" name="fileToUpload" id="fileToUpload">
                            </div>
                            <br>

                            <div class="cont_button">
                                <input type="submit" name="submit" value="ADD Post" />
                            </div>
                        </form>
                        </div>
                    </div>
                </div>


        </div>

    </div>
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content')
</script>
<script type='text/javascript' src="../../js/text_editer.js"></script>
<script type='text/javascript' src="../../js/option.js"></script>
<?php include_once('../temp/footer.php');?>
