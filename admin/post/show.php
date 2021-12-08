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
    include_once('../../database/post_model.php');
    $posts=select_all_post($conn,"p_id,p_img,p_title,p_date");
?>
<!-- search -->
 
<div class="active" id="nav_search" style="background:#343a40;padding: 20px 0px;">
    <form action="">
        <input type="text" style="display:flex;" class="btn_input" name="search search_text" id="search_text" placeholder="Enter your Search... Title , Date">
    </form>
    <br>
    <br>
    <div id="result">
       
    </div>
  <script type='text/javascript' src="../../js/search_post.js"></script>
    
</div>
<!--  / search -->
<hr>
<table class="table" style="width: 100%;" >
    <tr class="tr_border">
        <th class="th_top">Post Image </th>
        <th class="th_top">Post Title </th>
        <th class="th_top">Post Date </th>
        <th class="th_top">Update</th>
    </tr>
    <?php 
        // print  data
        if ($posts->num_rows > 0)
        {
            // output data of each row
            while($post = $posts->fetch_assoc())
            {
                echo'
                <tr class="tr_border">
                    <th class="th_center"><img src="../../img/posts/'.$post['p_img'].'" width="50px" height="50px" style="margin-top: 7px;"></th>
                    <th class="th_center">'.$post['p_title'].'</th>
                    <th class="th_center"style="padding: 10px 0px;">'.date('M d,Y',strtotime($post['p_date'])).'</th>
                    <th class="th_center">
                    <a class="btn_edit" href="update.php?p='.$post['p_id'].'&type=edit">Edite</a>
                    <a class="btn_delete" href="update.php?p='.$post['p_id'].'&type=delete">Delete</a>
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


