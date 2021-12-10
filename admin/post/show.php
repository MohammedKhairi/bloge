<?php include_once('../temp/header.php');?>
<?php
    //$_SESSION['info_admin_error'] = 'some think wrong!';
    //////////all data //////////////
    include_once('../../database/config.php');
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    //[[[[[[[[[[[[[ check the inputs ]]]]]]]]]]]]]
    include_once('../../database/post_model.php');
     //pagation
     $number_e=num_posts('p_id',$conn);
     $post_per_page=2;
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
    $posts=select_posts_admin('*','posts',$conn,$page);
?>
<!-- search -->
 

<!--  / search -->
<!--  Details List -->
<div class="details" style="grid-template-columns: repeat(1,1fr);">
<!-- order Details List -->
<div class="recentorder">
        <div class="cardHeader">
            <h2>Recent Posts</h2>
            <div class="btn_c">
                <a href="add.php" class="btn"><ion-icon name="add"></ion-icon> Post</a>
            </div>
           
        </div>
        <br>
       <?php 
       //search Result
       ?>
        <div id="result">
                        
        </div>
        <br>
        <table>
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Title</td>
                    <td>Date</td>
                    <td>Operation</td>
                </tr>
            </thead>
            <tbody>
            <?php 
                // print  data
                if ($posts->num_rows > 0)
                {
                    // output data of each row
                    while($post = $posts->fetch_assoc())
                    {
                        echo'
                        <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="../../img/posts/'.$post['p_img'].'" alt=""></div>
                        </td>
                            <td>'.$post['p_title'].'</td>
                            <td>'.date('M d,Y',strtotime($post['p_date'])).'</td>
                            <td>
                            <a href="update.php?p='.$post['p_id'].'&type=edit"><span class="status delivered">Edit</span></a>
                            <a  href="update.php?p='.$post['p_id'].'&type=delete"><span class="status return">Delete</span></a>
                            
                            </td>
                        </tr>
                        ';
                    }
                }
                else
                {
                    echo'
                    <tr>
                        <th collspan="3" class="th_center">No Post </th>

                    </tr>
                    ';
                }

            
            ?>        
            </tbody>
        </table>

        <br>
        <div class="pagination">
        <?php
        
            if($page>1)
            echo'<a class="pa" href="show.php?page='.($page-1).'">&laquo;  Prev </a>';
            $number_of_pags=ceil($number_e/ $post_per_page);
            echo '<a class="pa_num" href="show.php?page='.$page.'"class="active">'.$page.'</a>';
            if($page<$number_of_pags)
            echo'<a class="pa" href="show.php?page='.($page+1).'">Next  &raquo;</a>';
        //echo 'n-posts'.$number_e.'<br>';
        //echo 'n-page'.$number_of_pags;
        ?>
        </div>
    </div>

</div>
<?php include_once('../temp/footer.php');?>


