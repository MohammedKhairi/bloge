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
    include_once('../../database/category_model.php');
    $categories=select_all_categories($conn);
?>
<div class="details" style="grid-template-columns: repeat(1,1fr);">
<!-- order Details List -->
<div class="recentorder">
        <div class="cardHeader">
            <h2>Recent Category</h2>
            <div class="btn_c">
                <a href="add.php" class="btn"><ion-icon name="add"></ion-icon> Category</a>
            </div>
           
        </div>
        <table>
            <thead>
                <tr>
                    <td>Image</td>
                    <td>Title</td>
                    <td>Operation</td>
                </tr>
            </thead>
            <tbody>
            <?php 
            // print  data
                if ($categories->num_rows > 0)
                {
                    // output data of each row
                    while($cate = $categories->fetch_assoc())
                    {
                        echo'
                        <tr>
                        <td width="60px">
                            <div class="imgBx"><img src="../../img/category/'.$cate['c_img'].'" alt=""></div>
                        </td>
                            <td>'.$cate['c_title'].'</td>
                            <td>
                            <a href="update.php?cate='.$cate['c_id'].'&type=edit"><span class="status delivered">Edit</span></a>
                            <a  href="update.php?cate='.$cate['c_id'].'&type=delete"><span class="status return">Delete</span></a>
                            
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


