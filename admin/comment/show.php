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
    include_once('../../database/comment_model.php');
    $comment=select_all_comment($conn,'co_name,co_content,p_title,co_date,co_id');
?>
<div class="details" style="grid-template-columns: repeat(1,1fr);">
<!-- order Details List -->
<div class="recentorder">
        <div class="cardHeader">
            <h2>Recent Comment</h2>
            <div class="btn_c">
                <a href="show.php" class="btn"><ion-icon name="reload"></ion-icon> Reload</a>
            </div>
           
        </div>
        <table>
            <thead>
                <tr>
                    <td>user name</td>
                    <td>comment</td>
                    <td>post</td>
                    <td>date</td>
                    <td>Operation</td>
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
                            <td>'.mb_strcut($comm['co_content'],0,40,"UTF-8").'</td>
                            <td>'.$comm['p_title'].'</td>
                            <td>'.date('M d,Y',strtotime($comm['co_date'])).'</td>
                            <td>
                                <a href="update.php?comm='.$comm['co_id'].'&type=replay"><span class="status delivered">Reply</span></a>
                                 <a  href="update.php?comm='.$comm['co_id'].'&type=delete""><span class="status return">Delete</span></a>
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

</div>
<?php include_once('../temp/footer.php');?>


