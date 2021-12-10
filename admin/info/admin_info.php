
<?php include_once('../remp/header.php');?>

<!-- ########[content]######### -->
<div class="card">
    <div class="card_content">
            <div class="card_img">

            <img src="../../img/user/user.png"/>
            </div>
            <div class="info_u">
            <ul>
                <li>
                   <span style="color:#ee4266"> Name:</span> <?=$_SESSION['name']; ?>
                </li>
                <li>
                   <span style="color:#ee4266"> UserName:</span> <?=$_SESSION['uname']; ?>
                </li>
                <li>
                    <span style="color:#ee4266">Password :</span> <?=$_SESSION['upass']; ?>
                </li>
                <li>
                <span style="color:#ee4266">Email :</span> <?=$_SESSION['email']; ?>
                </li>
                <li>
                   <span style="color:#ee4266"> state :</span> <?php
                    if($_SESSION['ustate']==1)
                    echo'ADMIN';
                    ?>
                </li>
                
            </ul>
            </div>
            
    </div>
</div>

<!-- #########[content]######## -->
<?php include_once('../temp/footer.php');?>
