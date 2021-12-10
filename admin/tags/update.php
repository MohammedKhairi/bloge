<?php include_once('../temp/header.php');?>
<?php
/////////[update]/////////
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
            <div class="details" style="grid-template-columns: repeat(1,1fr);">
            <div class="recentorder">
                    <div class="cardHeader">
                        <h2>Add Tage</h2>
                        <div class="btn_c">
                            <a href="add.php" class="btn"><ion-icon name="arrow-back"></ion-icon> Back</a>
                        </div>
                    
                    </div>
                    <br>
                <form action="" method="post" enctype="multipart/form-data">
                    <label class="p_label" style="display: inline;">Tag Title</label>
                    <input type="text" name="name" value="'.$tage.'"class="btn_input" >
                    <br>
                    <br>
                    <br>
                    <br>
                    <input type="submit"   name="submit" value="Update" class="btn_submit">
                </form> 
                </div>
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

<?php include_once('../temp/footer.php');?>


