<?php 

    include_once('database/category_model.php');
    //category data
    $categories =select_categories($conn);
    //////////all data //////////////
?>
    </div>
<!-- website all post section -->
 <!-- blocks section -->
 <div class="web_block">
        <br>
        <!-- ####################################### -->

           <!-- category block -->
            <!-- block title -->
                <div class="post_cat">
                        <div class="section_title">
                            <h2 class="title">
                                Youtube 
                            </h2>
                        </div>
                </div>
                <div class="youtube" style='width:100%;height:100px;'>
                    <script src="https://apis.google.com/js/platform.js"></script>
                    <div class="g-ytsubscribe"  data-channelid="UCg0Tx0SpESzhwgtObzp6p1Q"
                    
                     date-layout="full" data-count="default">

                    </div>
                </div>


                <div class="post_cat">
                        <div class="section_title">
                            <h2 class="title">
                                categories
                            </h2>
                        </div>
                </div>
            <!-- block title -->
             <!-- block content -->
                <div class="B_content_l">
                    <ul>
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
             <!-- block content -->

           <!-- category block -->
           <br>
           <br>
<!-- ####################################### -->
           <!-- message  block -->
            <!-- block title -->
            <div class="post_cat">
                    <div class="section_title">
                        <h2 class="title">
                            message
                        </h2>
                    </div>
            </div>
            <!-- block title -->

            <!-- block content -->
            <div class="newsletter_widget">
                <?php
                    if(!isset($_SESSION['u_id']))
                    {
                        echo '<p class="errores" style="background:#5e8c2a;">
                        Pless <a href="user/login.php">Login</a> Or <a href="user/register.php">Register</a> to start Message
                        </p>';
                    }

                ?>
                <?php
                    if(isset($_SESSION['true_message']))
                    {
                        echo '<p class="errores" style="background:#5e8c2a;">
                        '.$_SESSION['true_message'].'
                        </p>';
                    }
                    unset($_SESSION['true_message']);
                ?>
                    

                <form action="user/message.php" method="post">
                    <p>leve us message to help you about your problem</p>
                    <?php
                        //session_start();
                        if(isset($_SESSION['error_message']))
                        {
                            echo '<p class="errores">'
                            .$_SESSION['error_message'].
                            '</p>';
                        }
                        unset($_SESSION['error_message']);
                                
                    ?>
                    <input type="text" name="name" class="input" value="<?php if(isset($_SESSION['name'])){echo$_SESSION['name'];}?>" placeholder="Enter Your name">
                    <label class="txtx" for="w3review">Enter Your Message :</label>
                    <textarea name="content" class="inputs" rows="4" cols="50">
                    </textarea>
                    <button class="primary_button" name="submit" type="submit">
                        SEND
                    </button>
                </form>
                
            </div>
            <!-- block content -->
           <!-- message  block -->

   <br>
   <br>
   <!-- ####################################### -->

           <!-- Popular   block -->
            <!-- block title -->
            <!-- block title -->

            <!-- block content -->

                <!-- posts -->
                <!-- <div class="Popular_content">
                        <a href="" class="post_image">
                                <img src="img/pupge.jpg" alt="" srcset="">
                            </a>
                            <div class="post_body">
                                <div class="post_categ">
                                    <a href="">GAME</a>
                                </div>
                                <h3 class="p_title">
                                    <a href="">download pubge for android game</a>
                                </h3>
                            </div>
                </div> -->
                <!-- /posts -->
            <!-- block content -->
           <!-- Popular   block -->
<!-- ####################################### -->
