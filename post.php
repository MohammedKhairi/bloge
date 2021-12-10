<?php 
    if(!(isset($_GET['p'])))
    {
        header('Location: '.'index.php');  
        exit; 
    }
    if($_GET['p']==NULL)
    {
        header('Location: '.'index.php');  
        exit;  
    }
    include_once('templat/header.php');

    include_once('database/post_model.php');
    include_once('database/comment_model.php');
    //check post if found
    $check_post=check_post($conn,$_GET['p']);
        if($check_post==0)
        {
            header('Location: '.'../index.php');
            //echo'data out';
            exit;
        }
    //post data
    $o_post =select_one_post('p_id,p_title,p_content,p_date,p_img,p_tags,c_id,c_title',$conn,$_GET['p']);
    $rowp = $o_post->fetch_assoc();
    //releted post
    $r_post =select_three_r_post('p_id,p_title,p_date,p_img,c_id,c_title',$conn,$_GET['p'],$rowp['c_id']);
    // comment in the post
    $co_post=select_comment_post('p_id,p_title,p_img,co_id,co_name,co_content,co_date',$conn,$_GET['p']);

    //////////all data //////////////
?>


<!-- ####################################### -->

<!-- web content -->
<div class="web_content">
<!-- website all post section -->
    <div class="web_post">
<!-- ######################################## -->
        <!-- post -->
        <?php
            echo'
                <figure style="width: 100%; float: none; margin: auto">
                    <img src="img/posts/'.$rowp['p_img'].'"style="height: 30rem;" height: 30rem; width="100%;">
                    <ul class="post_meta">
                        <li><a href="">Mohammed</a></li>
                        <li>'.date('M d,Y',strtotime($rowp["p_date"])).'</li>
                        <!-- number of comment -->
                        <li class="fa fa-comments" style="color: #97989b;font-weight: 700;">'.$co_post->num_rows.'</li>
                        
                    </ul>
                </figure>

                <!-- post_title -->

                <h3 class="p__title">'.$rowp['p_title'].'</h3>
                <!-- / post_title -->

                <!-- post content -->

            <div class="po_content">
            '.$rowp['p_content'].'
            </div>
                <!--  / post content -->
            ';
        ?>
        <!-- how many see post -->
        <!-- <li class="fa fa-eye" style="color: #97989b;font-weight: 700;">33</li> -->
<!-- ####################################### -->

  <!--   post tags -->

  <div class="post_cat">
        <div class="section_title">
            <h2 class="title">
                 POST TAGS
            </h2>
        </div>
    </div>
    <ul class="footer_tag">
    <?php 

    $tag = explode(" ", $rowp['p_tags']);
    foreach($tag as $i):
    echo'
        <li><a href="">'.$i.'</a></li>
        ';
    endforeach;
        
    ?>
    </ul>
<br>
<!-- ####################################### -->

  <!--   post related -->

    <div class="post_cat">
        <div class="section_title">
            <h2 class="title">
                RELATED POST
            </h2>
        </div>
    </div>


  <table style="width: 100%;">
<tr>
<?php
 while($rowr = $r_post->fetch_assoc())
 {
     echo'
     <td>
        <div class="post1 post2">
                <a href="post.php?p='.$rowr['p_id'].'" class="post__image" >
                    <img src="img/posts/'.$rowr['p_img'].'" alt="" srcset="">
                </a>
                <div class="post_categ">
                        <a href="category.php?cate='.$rowr['c_id'].'">'.$rowr['c_title'].'</a>
                </div>
                <h3 class="p_title">
                    <a href="post.php?p='.$rowr['p_id'].'" style="font-size: 15px;">'.$rowr['p_title'].'</a>
                </h3>
                <ul class="post_meta">
                    <li><a href="">Mohammed</a></li>
                    <li>'.date('M d,Y',strtotime($rowr["p_date"])).'</li>

                </ul>
        </div>
    </td>
     
     
     ';

 }
?>
  
    

</tr>
  </table>
  <!--  / post related -->



<!-- ####################################### -->


  <!--  post comment -->
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class="post_cat">
        <div class="section_title">
            <h2 class="title">
                LEVE COMMENT
            </h2>
        </div>
    </div>
    <br>
    <?php 
        // عرض رسالة للمستخدم عند الخطا

        if(isset($_SESSION['comment_add']))
        {
            echo '<p style="font-family: cursive;background-color: #81c75d;padding: 10px 0px;text-align: center;color: #fff;">
            '.$_SESSION['comment_add'].
            '</p>';  
            unset($_SESSION['comment_add']);     
            
        }             
    ?>
    <br>
    <form action="user/comment.php" method="post">
           <input type="text" name="name" class="btn_input btn_input5" placeholder=" pless Enter your name....." > <br>
            <br>
            <br>
           <textarea name="content" id="" style="height:150px;" class="btn_input btn_input4"  placeholder="Message.....">
           </textarea>

           <input type="hidden" id="custId" name="p" value="<?php echo $_GET['p']?>">
            <button type="submit" name="submit" class="primary_button" >
                ADD
            </button>
    </form>
 <!-- ########### --> 
 <br>
 <br>
 <!-- ########### -->   


    <div class="post_cat">
        <div class="section_title">
            <h2 class="title">
            <?php
                echo $co_post->num_rows.'  COMMENT'; 
            ?>
            </h2>
        </div>
    </div>


    <div class="all_comment">
        <?php
            while($rowco = $co_post->fetch_assoc())
            {
                echo'
                <div class="comment_p">
                    <div class="imag_p">
                        <img src="img/user/user.png" alt="" srcset="">
                    </div>

                    <div class="comment_body">
                            <ul class="comment_info">
                                    <li><a href="http://">'.$rowco['co_name'].'</a></li>
                                    <li style="margin-left: 13px;">'.date('M d,Y',strtotime($rowco["co_date"])).'</li>
                            </ul>
                            <p> 
                                '.$rowco['co_content'].'
                            </p>
                            ';
                            ///replay on comment section
                            get_reply_comment($conn,$rowco['co_id']);

                            
                           echo '

                    </div>
                </div> 
                ';
                
            }
        ?>
        



    </div>
  <!--  / post comment -->


         <!-- /post -->
<!-- ######################################## -->

<!-- website all post section -->

<?php include_once('templat/block.php');?>
<?php include_once('templat/footer.php');?>
