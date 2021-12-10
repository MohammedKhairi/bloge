</div>
 <!-- blocks section -->
 <?php 
    include_once('database/category_model.php');
    include_once('database/tags_model.php');
    //category data
    $categories =select_categories($conn);
    //tags data
    $tags =select_tags($conn);
    $conn->close();
    //////////all data //////////////
?>
</div>
<!-- web content -->

<!-- contener -->

</div>
<!-- footer -->
<footer id="fo_footer">
    <div class="footer_content">
        <div class="row">
            <div class="row_c">
                <div class="row_c_content">
                    <br>
                    <br>
                    <div class="footer_logo">
                        <a href=""><img src="css/img/logo.png" alt="" srcset=""style="width:220px;"></a>
                    </div>
                    <p class="footer_about">
                        this website give you all new Technology APPs Education  etc..
                    </p>
                    <ul class="contact_social">
                        <li><a href="#" class="fa fa-facebook"></a></li>
                        <li><a href="#" class="fa fa-twitter"></a></li>
                        <li><a href="#" class="fa fa-instagram"></a></li>
                        <li><a href="#" class="fa fa-youtube"></a></li>
                    </ul>
                </div>
            </div>
            <div class="row_c">
                <div class="row_c_content">
                   <h3 class="footer_title"> categories</h3>
                        <div class="B_content">
                                <ul class="f_category">
                                <?php
                                    // print  data
                                    if ($categories->num_rows > 0)
                                    {
                                        // output data of each row
                                        while($row = $categories->fetch_assoc())
                                        {
                                            echo'
                                            <li><a href="">'.$row["c_title"].' <span>'.$row["number_c"].'</span>  </a></li>
                                            ';
                                        }
                                    }
                                    else
                                    {
                                    echo "0 results";
                                    }         
                                ?>
                                </ul>
                            </div>
                </div>
            </div>
            <div class="row_c">
                <div class="row_c_content">
                    <h3 class="footer_title"> tags</h3>
                    <ul class="footer_tag">
                    <?php
                        // print  data
                        if ($tags->num_rows > 0)
                        {
                            // output data of each row
                            while($rowS = $tags->fetch_assoc())
                            {
                                echo'
                                    <li><a href="">'.$rowS["t_name"].'</a></li>
                                    ';
                            }
                        }
                        else
                        {
                        echo "0 results";
                        }         
                    ?>
                    </ul>
                </div>
            </div>
            <div class="row_c">
                <div class="row_c_content">
                    <h3 class="footer_title"> SUBSCRIPE</h3>
                    <?php
                        if(isset($_SESSION['true_subscrip']))
                        {
                            echo '<p class="errores" style="background:#5e8c2a;">
                            '.$_SESSION['true_subscrip'].'
                            </p>';
                        }
                        unset($_SESSION['true_subscrip']);
                    ?>
                    <p class="footer_about">
                        Pless subscripe to website to arived to you all the new product
                    </p>
                    <?php
                        //session_start();
                        if(isset($_SESSION['error_subscrip']))
                        {
                            echo '<p class="errores">'
                            .$_SESSION['error_subscrip'].
                            '</p>';
                        }
                        unset($_SESSION['error_subscrip']);
                                
                    ?>
                    <form action="user/subscrip.php" method="post">
                            <input type="email" name="email"class="btn_input btn_input3" placeholder="Enter Your Email">
                            <button class="primary_button p_button" type="submit" name="submit">
                                subscripe
                            </button>
                    </form>
                </div>
            </div>

        </div>

   <!-- ################################# -->
  <br>        
  <!-- ################################# -->
        <!-- footer BOTTOM -->
        <div class="footer_botton">
            <div class="footer_botton_copy_right">
                    <p class="footer_about">                     
                      Copyright ©   2019 All rights of design are Reserved For Mohaemed Khairi with 
                      <i class="fa fa-heart-o" aria-hidden="true"></i>
                    </p>
            </div>

            <div class="footer_botton_web_prev">
                <ul class="footer_nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="aboutus.php">About Us</a></li>
                    <li><a href="contactus.php">Contact</a></li>
                    <li><a href="privcy.php">Privcy</a></li>
                </ul>
            </div>
        </div>
        <br>
        <br>
        <!-- footer BOTTOM -->
    </div>
</footer>


<!-- footer -->

<?php
    if(isset($_SESSION['w_mode']))
    {
      //  echo $_SESSION['w_mode'];
        if($_SESSION['w_mode']=="defult")
        {
           // echo'whit';
            echo '<script>
            
            chang_to_defult();
            </script>';
        }
    else if($_SESSION['w_mode']=="dark")
        {
      //  echo'black';
        echo '<script>chang_to_dark();</script>';

        }
    }
    ?>

    <?php
    if(isset($_SESSION['menu']))
    {
      //  echo $_SESSION['w_mode'];
        if($_SESSION['menu']=="home")
        {
           // echo'whit';
            echo '<script>
                chang_to_home();
            </script>';
        }
        else
        {
            //  echo'black';
            echo '<script>chang_to_cate("'.$_SESSION['menu'].'");</script>';

        }
    }
    
    
    
    ?>

<!-- secript here -->
<script type='text/javascript' src="js/menu.js"></script>
<script type='text/javascript' src="js/menu_change.js"></script>

<!-- secript here -->

</body>
</html>