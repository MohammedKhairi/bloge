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
            include_once('../../database/post_model.php');
            $cate_delete=delete_one_post($conn,$_GET['p']);
            $conn->close();
            include_once('../../include/bulid_f.php');
            if($cate_delete==1)
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
           include_once('../../database/post_model.php');
           $post_one=one_post('*',$conn,$_GET['p']);
           $post = $post_one->fetch_assoc();
            include_once('../../database/category_model.php');
            include_once('../../database/tags_model.php');
            //post data
            //category post
            $categories =select_all_categories($conn);
            // tags
            $tags=select_tags($conn);
            $conn->close();
           echo
           '<div class="details" style="grid-template-columns: repeat(1,1fr);" onload="enableediter();"">
           <div class="recentorder">
           ';
           ///print error
           if(isset($_SESSION['edit_error']))
                {
                    echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
                    '.$_SESSION['edit_error'].
                    '</p>';  
                    unset($_SESSION['edit_error']);     
                } 
           echo'
            <form action="edit.php?p='.$_GET['p'].' &p_type=title" method="post" enctype="multipart/form-data">
                    <label class="p_label" >Post Title</label>
                    <input type="text" name="title" class="btn_input" value="'.$post['p_title'].'" >
                    
                    <input type="submit"   name="submit" value="UPDATE" class="btn_submit">
                </form> 
            <br>
            <hr>
            <br>
           ';
           echo'
            <form action="edit.php?p='.$_GET['p'].'&p_type=content" method="post" enctype="multipart/form-data">
                    <label class="p_label" >Post content</label>
                    
                    <textarea name="content" id="froala-editor" style="display: inline;color: #ee4266;padding: 0px; margin-left: 5px;" class="input"  placeholder="Message.....">
                    '.$post['p_content'].'
                    </textarea>
                    <input type="submit"   name="submit" value="UPDATE" class="btn_submit">
                </form> 
            <br>
            <hr>
            <br>
           ';
           echo'
            <form action="edit.php?p='.$_GET['p'].'&p_type=category" method="post" enctype="multipart/form-data">
                    <label class="p_label">Post Category</label>
                    
                    <input type="text" name="category" value="'.$post['p_c_id'].'"  id="b_value" placeholder="chose Category..." class="btn_input"  onclick="show_option()">
                    <div class="option" id="list">';
                            while($cate=$categories->fetch_assoc())
                            {
                            echo'
                                    <p onclick="get_value('.$cate["c_id"].')" class="p_o" value='.$cate["c_id"].'>
                                        '. $cate["c_title"].'
                                    </p>
                                    <hr>
                                ';
                            }
                    
                        echo'
                    </div>
                   
                    <input type="submit"   name="submit" value="UPDATE" class="btn_submit">
                </form> 
            <br>
            <hr>
            <br>
          ';
          echo'
                <form action="edit.php?p='.$_GET['p'].'&p_type=tagg" method="post" enctype="multipart/form-data">
                    <label class="p_label" >Post Tags</label>
                    
                    <input type="text" name="tagess" id="b_value2" value="'.$post['p_tags'].'"  class="btn_input" placeholder="chose Tage..." onclick="show_option2()">
                        <div class="option2" id="list2">';
                            
                    
                                while($tag=$tags->fetch_assoc())
                                {
                                    $name='\''.$tag["t_name"].'\'';
                                echo'
                                    <span class="s_list">'.$tag["t_name"].' </span> 
                                     <input type="checkbox" id="vehicle1" onclick="get_value2('.$name.')" class="p_o" name="tage" value="'.$tag["t_id"].'">
                    
                                        <hr>
                                    ';
                                }
                            echo'
                        </div>
                
                    <input type="submit"   name="submit" value="UPDATE" class="btn_submit">
                </form> 

                <br>
                <hr>
                <br>
           ';


           echo'
            <form action="edit.php?p='.$_GET['p'].'&p_type=p_p_img" method="post" enctype="multipart/form-data">
                <label class="p_label" >Post Image</label>
                <input style="line-height: 3px;" class="btn_input" type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit"   name="submit" value="UPDATE" class="btn_submit">
            </form> 
            
           ';

      
             echo'</div> </div>';
      
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
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content')
</script>
<script type='text/javascript' src="../../js/option.js"></script>
<?php include_once('../temp/footer.php');?>


