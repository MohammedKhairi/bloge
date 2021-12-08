
<?php include_once('../template/header.php');?>
<?php
    if(isset($_POST['submit']))
    {
        if(isset($_POST['name']))
        {
            if($_POST['name']==NULL)
            {
                $_SESSION['tag_error'] = 'Pless full all Record';
            }
            else
            {
                // Check connection
                include_once('../../database/config.php');
                if ($conn->connect_error) 
                {
                    die("Connection failed: " . $conn->connect_error);
                }
                    include_once('../../database/tags_model.php');
                    $title=$_POST['name'];
                    $add=add_tags($conn,$title);
                    $conn->close();
                    if($add)
                    {
                        include_once('../../include/bulid_f.php');
                        refresh('show.php',0);
                        exit;
                    }
                    else
                    {
                       $_SESSION['tag_error']="this tage is repeted or some think woring";
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

    if(isset($_SESSION['tag_error']))
    {
        echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
        '.$_SESSION['tag_error'].
        '</p>';  
        unset($_SESSION['tag_error']);     
        
    }             
?>
<form action="" method="post" enctype="multipart/form-data">
    <label class="p_label" style="display: inline;">Tag Title</label>
    <input type="text" name="name" class="btn_input" >
    <br>
    <br>
    <br>
    <br>
    <input type="submit"   name="submit" value="ADD" class="btn_submit">
</form> 
<script type='text/javascript' src="../../js/panal_admin.js"></script>
<?php include_once('../template/footer.php');?>