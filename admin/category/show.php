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
    include_once('../../database/category_model.php');
    $categories=select_all_categories($conn);
?>
<table class="table" style="width: 100%;" >
    <tr class="tr_border">
        <th class="th_top">Category Image </th>
        <th class="th_top">Category Title </th>
        <th class="th_top">Update</th>
    </tr>
    <?php 
        // print  data
        if ($categories->num_rows > 0)
        {
            // output data of each row
            while($cate = $categories->fetch_assoc())
            {
                echo'
                <tr class="tr_border">
                    <th class="th_center"><img src="../../img/category/'.$cate['c_img'].'" width="50px" height="50px" style="margin-top: 7px;"></th>
                    <th class="th_center">'.$cate['c_title'].'</th>
                    <th class="th_center">
                    <a class="btn_edit" href="update.php?cate='.$cate['c_id'].'&type=edit">Edite</a>
                    <a class="btn_delete" href="update.php?cate='.$cate['c_id'].'&type=delete">Delete</a>
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


