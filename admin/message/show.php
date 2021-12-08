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
    include_once('../../database/message_model.php');
    $message=select_all_messages($conn);
    $conn->close();
?>
<table class="table" style="width: 100%;" >
    <tr class="tr_border">
        <th class="th_top">name</th>
        <th class="th_top">Message Content</th>
        <th class="th_top">Message Date</th>
        <th class="th_top">Update</th>
    </tr>
    <?php 
        // print  data
            // output data of each row
            while($mess = $message->fetch_assoc())
            {
                echo'
                <tr class="tr_border">
                    <th class="th_center"style="padding: 10px 0px;">'.$mess['m_name'].'</th>
                    <th class="th_center"style="padding: 10px 0px;">'.mb_strcut($mess['m_content'],0,40,"UTF-8").'</th>
                    <th class="th_center"style="padding: 10px 0px;">'.date('M d,Y',strtotime($mess['m_date'])).'</th>
                    <th class="th_center"style="padding: 10px 0px;">
                    <a class="btn_edit" href="update.php?mess='.$mess['m_id'].'&type=replay">Replay</a>
                    <a class="btn_delete" href="update.php?mess='.$mess['m_id'].'&type=delete">Delete</a>
                    </th>
                <tr>
                ';
            }


       
    ?>

</table>
<script type='text/javascript' src="../../js/panal_admin.js"></script>
<?php include_once('../template/footer.php');?>


