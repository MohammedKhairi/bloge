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
    $posts=select_all_post($conn,"p_id,p_img,p_title,p_date",5);
?>
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
    include_once('../../database/comment_model.php');
    $comment=select_all_comment($conn,'co_name,co_content,co_date,co_id');
?>
<div class="details">
<!-- order Details List -->
<div class="recentorder">
        <div class="cardHeader">
            <h2>Recent Posts</h2>
            <div class="btn_c">
                <a href="../post/show.php" class="btn"><ion-icon name="eye"></ion-icon> View All</a>
                <a href="../post/add.php" class="btn"><ion-icon name="add"></ion-icon> Post</a>
            </div>
           
        </div>
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
                            <a href="../post/update.php?p='.$post['p_id'].'&type=edit"><span class="status delivered">Edit</span></a>
                            <a  href="../post/update.php?p='.$post['p_id'].'&type=delete"><span class="status return">Delete</span></a>
                            
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
</div>
<div class="recentCustomers">
            <div class="cardHeader">
                <h2>Recent Comments</h2>
                <div class="btn_c">
                <a href="../comment/show.php" class="btn"><ion-icon name="eye"></ion-icon> View All</a>
            </div>
            </div>
            <table>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Date</td>
                    <td>Contant</td>
                    <td>Replay</td>
                </tr>
            </thead>
            <tbody>
            <?php 
            // print  data
                if ($comment->num_rows > 0)
                {
                    // output data of each row
                    while($comm = $comment->fetch_assoc())
                    {
                        echo'
                        <tr>
                            <td>'.$comm['co_name'].'</td>
                            <td>'.date('M d,Y',strtotime($comm['co_date'])).'</td>
                            <td>'.mb_strcut($comm['co_content'],0,10,"UTF-8").'</td>
                            <td>
                                <a 
                                    href="../comment/update.php?comm='.$comm['co_id'].'&type=replay">
                                    <span class="status delivered"><ion-icon name="arrow-undo-outline"></ion-icon>
                                    </span>
                                </a>
                            </td>
                        </tr>
                        ';
                    }
                }
                else
                {
                    echo'
                    <tr>
                        <th collspan="3" class="th_center">No Category </th>
                    </tr>
                    ';
                }

            
            ?>         
            </tbody>
        </table>
        </div>
<?php include_once('../temp/footer.php');?>
  