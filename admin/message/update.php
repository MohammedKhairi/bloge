<?php include_once('../temp/header.php');?>


<?php
    /////////[add replay]/////////
if(isset($_POST['submit']))
   {
       //delete
       if(!empty(str_replace(' ', '', $_POST['content'])))
       {
            include_once('../../database/config.php');
            // Check connection
            if ($conn->connect_error) 
            {
                die("Connection failed: " . $conn->connect_error);
            }
            include_once('../../database/message_model.php');
            $replay=$_POST['content'];
            $co_replay=replay_message($conn,$replay,$_GET['mess']);
            $conn->close();
            include_once('../../include/bulid_f.php');
            if($co_replay==1)
            {
                refresh('show.php',0);
                exit;
            }
            else
            {
                $_SESSION['edit_error']="some think error !";
            }
       }
       else
       {
           $_SESSION['edit_error']="Pless Full All Record";
       }
    }

?>
<?php
   if(isset($_GET['type'],$_GET['mess']))
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
            include_once('../../database/message_model.php');
            $mess_delete=delete_one_message($conn,$_GET['mess']);
            $conn->close();
            include_once('../../include/bulid_f.php');
            if($mess_delete==1)
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
       else if($_GET['type']=='replay')
       {
           //////////all data //////////////
           include_once('../../database/config.php');
           // Check connection
           if ($conn->connect_error) 
           {
               die("Connection failed: " . $conn->connect_error);
           }
           //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
           include_once('../../database/message_model.php');
           $mess_one=select_one_message($conn,$_GET['mess']);
           $mess = $mess_one->fetch_assoc();
           echo
           '
           <div class="details" style="grid-template-columns: repeat(1,1fr);">
           <div class="recentorder">
                <div class="cardHeader">
                    <h2>Update Comment</h2>
                    <div class="btn_c">
                        <a href="add.php" class="btn"><ion-icon name="add"></ion-icon> Category</a>
                    </div>
                 
                </div>
                
            <br>
           <p class="p_comm"> <span style="color:#ee4266;">Person Name : </span>'.$mess["m_name"].'</p>
           <p class="p_comm"> <span style="color:#ee4266;">Message content : </span>'.$mess["m_content"].'</p>
           <p class="p_comm"> <span style="color:#ee4266;">Message Date : </span>'.date('M d,Y',strtotime($mess['m_date'])).'</p>
           <br><br>
            <hr>
           <br><br>';
           /////message error
           if(isset($_SESSION['edit_error']))
                {
                    echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
                    '.$_SESSION['edit_error'].
                    '</p>';  
                    unset($_SESSION['edit_error']);     
                    
                } 
                if(isset($_SESSION['edit_p_error']))
                {
                    echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
                    '.$_SESSION['edit_p_error'].
                    '</p>';  
                    unset($_SESSION['edit_p_error']);     
                    
                }
            echo'
           <form action="" method="post">
                <label style="width: 200px;" class="p_label">Replay Content</label>
                <br>
                <br>

                <textarea name="content" id="" style="height:150px;" class="btn_input"  placeholder="Message.....">
                </textarea>
                <br>
                <br>
                <input type="submit"   name="submit" value="REPLAY" class="btn_submit">
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


