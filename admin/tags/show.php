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
    include_once('../../database/tags_model.php');
    $tags=select_tags($conn);
?>
<div class="details" style="grid-template-columns: repeat(1,1fr);">

<div class="recentorder">
        <div class="cardHeader">
            <h2>Recent Tags</h2>
            <div class="btn_c">
                <a href="show.php" class="btn"><ion-icon name="reload"></ion-icon> Reload</a>
                <a href="add.php" class="btn"><ion-icon name="add"></ion-icon> Add</a>
            </div>
           
        </div>
        <br>
        <table>
            <thead>
                <tr>
                    <td>Tage Name</td>
                    <td>Operation</td>
                </tr>
            </thead>
            <tbody>
             <?php 
                // print  data
                if ($tags->num_rows > 0)
                {
                    // output data of each row
                    while($tag = $tags->fetch_assoc())
                    {
                        echo'
                        <tr class="tr_border">
                            <td >'.$tag['t_name'].'</td>
                            <td >
                            <a href="update.php?tag='.$tag['t_id'].'&type=edit"><span class="status delivered">Edit</span></a>
                            <a  href="update.php?tag='.$tag['t_id'].'&type=delete"><span class="status return">Delete</span></a>
                            </td>
                        </tr>
                        ';
                    }
                }
                else
                {
                    echo'
                    <tr>
                        <td collspan="3" class="th_center">No Tags </th>

                    </tr>
                    ';
                }

            
            ?>       
            </tbody>
        </table>
</div>

<?php include_once('../temp/footer.php');?>


