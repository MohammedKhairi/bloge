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
    include_once('../../database/tags_model.php');
    $tags=select_tags($conn);
?>
<table class="table" style="width: 100%;" >
    <tr class="tr_border">
        <th class="th_top">Tage name  </th>
        <th class="th_top">Update</th>
    </tr>
    <?php 
        // print  data
        if ($tags->num_rows > 0)
        {
            // output data of each row
            while($tag = $tags->fetch_assoc())
            {
                echo'
                <tr class="tr_border">
                    <th class="th_center"style="padding: 10px 0px;">'.$tag['t_name'].'</th>
                    <th class="th_center"style="padding: 10px 0px;">
                    <a class="btn_edit" href="update.php?tag='.$tag['t_id'].'&type=edit">edit</a>
                    <a class="btn_delete" href="update.php?tag='.$tag['t_id'].'&type=delete">Delete</a>
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


