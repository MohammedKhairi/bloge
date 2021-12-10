<?php include_once('../temp/header.php');?>

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
            include_once('../../database/category_model.php');
            $cate_delete=delete_one_categories($conn,$_GET['cate']);
            $conn->close();
            include_once('../../include/bulid_f.php');
            if($cate_delete==1)
            {
                refresh('show.php',3);
                exit;
 
            }     
            else
            {
                refresh('show.php',3);
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
           include_once('../../database/category_model.php');
           $cate_one=select_one_category('c_id,c_title,c_img',$conn,$_GET['cate']);
           $cate = $cate_one->fetch_assoc();
           echo
           '<div class="details" style="grid-template-columns: repeat(1,1fr);">
           <!-- order Details List -->
           <div class="recentorder">
                   <div class="cardHeader">
                       <h2>Recent Category</h2>
                       <div class="btn_c">
                           <a href="show.php" class="btn"><ion-icon name="add"></ion-icon> Category</a>
                       </div>
                      
                   </div>
                   <br>
           ';
           if(isset($_SESSION['name_error']))
                {
                    echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
                    '.$_SESSION['name_error'].
                    '</p>';  
                    unset($_SESSION['name_error']);     
                } 
           echo'
           <form action="edit.php?cate='.$_GET['cate'].'" method="post" enctype="multipart/form-data">
                <label class="p_label" >Category Title</label>
                <input type="text" value="'.$cate['c_title'].'" name="name" class="btn_input" >
                <input type="submit"   name="submit" value="UPDATE" class="btn_submit">
            </form> 
           <br>
           <hr>
           <br>
           ';
           if(isset($_SESSION['img_error']))
                {
                    echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
                    '.$_SESSION['img_error'].
                    '</p>';  
                    unset($_SESSION['img_error']);     
                } 
           echo'
            <form action="edit.php?cate='.$_GET['cate'].'" method="post" enctype="multipart/form-data">
                <label class="p_label" >Category Image</label>
                <input style="color:#ee4266;" type="file" class="btn_input" style="line-height: 60px;" name="fileToUpload" id="fileToUpload">
                <input type="submit"   name="submit" value="UPDATE" class="btn_submit">
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


