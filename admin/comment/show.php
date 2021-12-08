<?php include_once('../template/header.php');?>
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
<table class="table" style="width: 100%;" >
    <tr class="tr_border">
        <th class="th_top">name  </th>
        <th class="th_top">comment</th>
        <th class="th_top">Post</th>
        <th class="th_top">Date</th>
        <th class="th_top">Update</th>
    </tr>
    <?php 
        // print  data
        if ($comment->num_rows > 0)
        {
            // output data of each row
            while($comm = $comment->fetch_assoc())
            {
                echo'
                <tr class="tr_border">
                    <th class="th_center"style="padding: 10px 0px;">'.$comm['co_name'].'</th>
                    <th class="th_center"style="padding: 10px 0px;">'.mb_strcut($comm['co_content'],0,40,"UTF-8").'</th>
                    <th class="th_center"style="padding: 10px 0px;">'.$comm['p_title'].'</th>
                    <th class="th_center"style="padding: 10px 0px;">'.date('M d,Y',strtotime($comm['co_date'])).'</th>
                    <th class="th_center"style="padding: 10px 0px;">
                    <a class="btn_edit" href="update.php?comm='.$comm['co_id'].'&type=replay">Replay</a>
                    <a class="btn_delete" href="update.php?comm='.$comm['co_id'].'&type=delete">Delete</a>
                    </th>
                <tr>
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

</table>
<script type='text/javascript' src="../../js/panal_admin.js"></script>
<?php include_once('../template/footer.php');?>


