<?php include_once('../template/header.php');?>


<?php
/////////[add replay]/////////
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
                    $edit=update_tags($conn,$_GET['tag'],$title);
                    $conn->close();
                    if($edit)
                    {
                        include_once('../../include/bulid_f.php');
                        refresh('show.php',0);
                        exit;
                    }
                    else
                    {
                    $_SESSION['tag_error']="some think woring";
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
   if(isset($_GET['type']))
   {
       //delete
       if($_GET['type']=='delete')
       {
           //////////all data //////////////
            include_once('../../database/config.php');
            // Check connection
            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
            }
            //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
            include_once('../../database/tags_model.php');
            $tag_delete=delete_one_tag($conn,$_GET['tag']);
            $conn->close();
            include_once('../../include/bulid_f.php');
            if($tag_delete==1)
            {
                refresh('show.php',0);
                exit;
               
            }
            else
            {
                refresh('show.php',0);
                exit;
            }
       }
       //edite
       else if($_GET['type']=='edit')
       {
           //////////all data //////////////
           include_once('../../database/config.php');
           // Check connection
           if ($conn->connect_error) 
           {
               die("Connection failed: " . $conn->connect_error);
           }
           //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
           include_once('../../database/tags_model.php');
           // get one tage
           $tage=select_one_tag($conn,$_GET['tag']);
           $conn->close();
           /////message error
           if(isset($_SESSION['tag_error']))
                {
                    echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
                    '.$_SESSION['tag_error'].
                    '</p>';  
                    unset($_SESSION['tag_error']);     
                } 

            echo'
                    <form action="" method="post" enctype="multipart/form-data">
                    <label class="p_label" style="display: inline;">Tag Title</label>
                    <input type="text" name="name" value="'.$tage.'"class="btn_input" >
                    <br>
                    <br>
                    <br>
                    <br>
                    <input type="submit"   name="submit" value="Update" class="btn_submit">
                </form> 
           ';

       }
       // false get
       else
       {
            include_once('../../include/bulid_f.php');
            refresh('show.php',0);
            exit;
       }
   }
   else
   {
        include_once('../../include/bulid_f.php');
        refresh('show.php',0);
        exit;
   }
?>

<script type='text/javascript' src="../../js/panal_admin.js"></script>
<?php include_once('../template/footer.php');?>


