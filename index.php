

<?php include_once('templat/header.php');?>
 
<?php 
    include_once('database/post_model.php');
    //pagation
    $number_e=num_posts('p_id',$conn);
    $post_per_page=5;
    if(isset($_GET['page']))
    {
        if($_GET['page']==NULL)
            $page=1;
        else
            $page=$_GET['page'];
    }
    else
    {
        $page=1;
    }
    //post data
    $result =select_posts('*','posts',$conn,$page);
    
    //////////all data //////////////
?>


<br>
<br>
<!-- ####################################### -->

<!-- web content -->
<div class="web_content">
<!-- website all post section -->
    <div class="web_post">
    
        <!-- post title -->
        <!-- <div class="post_cat">
            <div class="section_title">
                <h2 class="title">
                    all post
                </h2>
            </div>
        </div> -->
        <!-- post title -->
       
        <!-- ALL POSTS -->
    <!-- ######################################## -->
        <!-- post -->
        <?php 
       // print  data
        if ($result->num_rows > 0)
        {
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                echo'
                <div class="post">
                    <a href="post.php?p='.$row["p_id"].'" class="post_image">
                        <img src="./img/posts/'.$row["p_img"].'" alt="" srcset="">
                    </a>
                    <div class="post_body">
                        <div class="post_categ">
                            <a href="category.php?cate='.$row["p_c_id"].'">'.$row["c_title"].'</a>
                        </div>
                        <h3 class="p_title">
                            <a href="post.php?p='.$row["p_id"].'">'.$row["p_title"].'</a>
                        </h3>
                        <ul class="post_meta">
                            <li><a href="">Mohammed</a></li>
                            <li>'.date('M d,Y',strtotime($row["p_date"])).'</li>
                        </ul>
                        <div class="post_content">
                        '.mb_strcut($row["p_content"],0,150,"UTF-8").'
                        </div>
                        <a class="primary_button" href="post.php?p='.$row["p_id"].'"> READ MORE
                        </a>
                        
                    </div>
                </div> <br>';
               
            }
        }
        else
        {
           // header('Location: '.'index.php'); 
            include_once('include/bulid_f.php');
            refresh('index.php',0); 
        }         
        ?>
        <!-- /post --> 
        <br>
        <br>
        <div class="pagination">
        <?php
        
            if($page>1)
            echo'<a class="pa" href="index.php?page='.($page-1).'">&laquo;  Prev </a>';
            $number_of_pags=ceil($number_e/ $post_per_page);
            echo '<a class="pa_num" href="index.php?page='.$page.'"class="active">'.$page.'</a>';
            if($page<$number_of_pags)
            echo'<a class="pa" href="index.php?page='.($page+1).'">Next  &raquo;</a>';
        //echo 'n-posts'.$number_e.'<br>';
        //echo 'n-page'.$number_of_pags;
        ?>
        </div>
<!-- ######################################## -->

        <!-- ALL POSTS -->



<?php include_once('templat/block.php');?>
<?php


if(isset($_SESSION['menu']))
{
    $_SESSION['menu']="home";
}
else
{
    $_SESSION['menu']="home";

}
?>
<?php include_once('templat/footer.php');?>

