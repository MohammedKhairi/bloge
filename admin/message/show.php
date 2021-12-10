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
    include_once('../../database/message_model.php');
    $message=select_all_messages($conn);
    $conn->close();
?>
<div class="details" style="grid-template-columns: repeat(1,1fr);">
<!-- order Details List -->
<div class="recentorder">
        <div class="cardHeader">
            <h2>Recent Message</h2>
            <div class="btn_c">
                <a href="show.php" class="btn"><ion-icon name="reload"></ion-icon> Reload</a>
            </div>
           
        </div>
        <table>
            <thead>
                <tr>
                    <td>user name</td>
                    <td>Message Content</td>
                    <td>Message Date</td>
                    <td>Operation</td>
                </tr>
            </thead>
            <tbody>
            <?php 
             // print  data
            // output data of each row
            while($mess = $message->fetch_assoc())
            {
                echo'
                <tr>
                    <td>'.$mess['m_name'].'</td>
                    <td>'.mb_strcut($mess['m_content'],0,40,"UTF-8").'</td>
                    <td>'.date('M d,Y',strtotime($mess['m_date'])).'</td>
                    <td>
                        <a href="update.php?mess='.$mess['m_id'].'&type=replay"><span class="status delivered">Reply</span></a>
                        <a  href="update.php?mess='.$mess['m_id'].'&type=delete"><span class="status return">Delete</span></a>
                    </td>
                <tr>
                ';
            }


       
    ?>       
            </tbody>
        </table>
    </div>

</div>
<?php include_once('../temp/footer.php');?>


