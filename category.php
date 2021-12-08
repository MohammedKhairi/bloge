<?php 
    if(!(isset($_GET['cate'])))
    {
        header('Location: '.'index.php');  
        exit; 
    }

    if($_GET['cate']==NULL)
    {
        header('Location: '.'index.php');  
        exit;  
    }
    include_once('templat/header.php');

    include_once('database/category_model.php');
    //pagation category
    $number_c=num_posts_category('c_id',$conn,$_GET['cate']);
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
    $result =posts_in_category('p_id,p_img,p_title,p_date,p_content,c_id,c_title ',$conn,$_GET['cate'],$page);
    // category data
    $category =select_one_category('*',$conn,$_GET['cate']);

    //print_r($result);exit;
    if ($result->num_rows > 0 && $category->num_rows > 0)
    {

    }
    else
    {
        include_once('include/bulid_f.php');
        refresh('index.php',0);
        exit;
    } 

    //////////all data //////////////
?>


<!-- category image -->

    <?php
        while($row = $category->fetch_assoc())
        {
            echo "<div class='category_image' data-stellar-background-ratio='0.5' style='background-image: url(img/category/".$row['c_img']." );background-size: cover;background-position: center;'>";
            echo '

                <div class="category_name">
                    <h1>'.$row['c_title'].'</h1>
                </div>
            </div>
            ';
        }
    ?>
    

<!-- category image -->


<br>
<br>
<!-- ####################################### -->

<!-- web content -->
<div class="web_content">
<!-- website all post section -->
    <div class="web_post">
        <!-- post title -->
        <div class="post_cat">
            <div class="section_title">
                <h2 class="title">
                    all post
                </h2>
            </div>
        </div>
        <!-- post title -->
       
        <!-- ALL POSTS -->
    <!-- ######################################## -->
        <!-- post -->
        <?php 
       // print  data
       
            // output data of each row
            while($row = $result->fetch_assoc())
            {
                echo'
                <div class="post">
                    <a href="post.php?p='.$row['p_id'].'" class="post_image">
                        <img src="./img/posts/'.$row["p_img"].'" alt="" srcset="">
                    </a>
                    <div class="post_body">
                        <div class="post_categ">
                            <a href="category.php?cate='.$row['c_id'].'">'.$row["c_title"].'</a>
                        </div>
                        <h3 class="p_title">
                            <a href="post.php?p='.$row['p_id'].'">'.$row["p_title"].'</a>
                        </h3>
                        <ul class="post_meta">
                            <li><a href="">Mohammed</a></li>
                            <li>'.date('M d,Y',strtotime($row["p_date"])).'</li>
                        </ul>
                        <p class="post_content">
                        '.mb_strcut($row["p_content"],0,180,"UTF-8").'
                        </p>
                        <a class="primary_button" href="post.php?p='.$row["p_id"].'"> READ MORE
                        </a>
                    </div>
                </div>';
               
            }
                
        ?>
        <!-- /post --> 
<!-- ######################################## -->

        <!-- ALL POSTS -->

        <br>
        <div class="pagination">
        <?php
        
            if($page>1)
            {
                echo'<a class="pa" href="category.php?cate='.($_GET['cate']).'&page='.($page-1).'">&laquo;  Prev </a>';
            }
            $number_of_pags=ceil($number_c/ $post_per_page);
            echo '<a class="pa_num" href="category.php?cate='.($_GET['cate']).'&page='.($page).'"class="active">'.$page.'</a>';
            if($page<$number_of_pags)
            {
                echo'<a class="pa" href="category.php?cate='.($_GET['cate']).'&page='.($page+1).'">Next  &raquo;</a>';
            }
        
        //  echo 'n-posts'.$number_c.'<br>';
        // echo 'n-page'.$number_of_pags.'<br>';
        // echo 'n-posts'.$page.'<br>';

        ?>
        </div>

<?php include_once('templat/block.php');?>
<?php include_once('templat/footer.php');?>