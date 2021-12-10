<?php
   session_start();
   if(!isset($_SESSION['ustate'],$_SESSION['email'],$_SESSION['upass'],$_SESSION['uname'],$_SESSION['name'],$_SESSION['u_id']))
   {
        $_SESSION['login_admin_error'] = 'Pless Login to show This page';
        header('Location: '.'../wp-admin.php');  
        exit;
   }
   //echo'admin'.$_SESSION['name'];
?>
<?php
    //$_SESSION['info_admin_error'] = 'some think wrong!';
    //////////all data //////////////
    include_once('../../database/config.php');
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    //[[[[[[[[[[[[[ get number of posts ,comment,category ,message]]]]]]]]]]]]]
    include_once('../../database/post_model.php');
    $posts_number=number_posts("p_id",$conn);
    $number_comments=number_comments("co_id",$conn);
    $number_message=number_message("m_id",$conn);
    $number_categories=number_categories("c_id",$conn); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin2.css">
    <script src="../../js/jquery-3.4.1.min.js"></script>
    <title>Dashboard</title>
</head>
<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="../info/dashboard.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashobard</span>
                    </a>
                </li>
                <li>
                    <a href="../post/show.php">
                        <span class="icon"><ion-icon name="apps-outline"></ion-icon></span>
                        <span class="title">Posts</span>
                    </a>
                </li>
                <li>
                    <a href="../info/admin_edit.php">
                        <span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                        <span class="title">Admin</span>
                    </a>
                </li>

                <li>
                    <a href="../category/show.php">
                        <span class="icon"><ion-icon name="ellipsis-vertical-outline"></ion-icon></span>
                        <span class="title">Category</span>
                    </a>
                </li>
                <li>
                    <a href="../comment/show.php">
                        <span class="icon"><ion-icon name="chatbubbles-outline"></ion-icon></span>
                        <span class="title">Comment</span>
                    </a>
                </li>
                <li>
                    <a href="../message/show.php">
                        <span class="icon"><ion-icon name="chatbox-ellipses-outline"></ion-icon></span>
                        <span class="title">Message</span>
                    </a>
                </li>
                <li>
                    <a href="../tags/show.php">
                        <span class="icon"><ion-icon name="bookmark-outline"></ion-icon></span>
                        <span class="title">Tags</span>
                    </a>
                </li>

                
                <li>
                    <a href="../info/logout.php">
                        <span class="icon"><ion-icon name="log-in-outline"></ion-icon></span>
                        <span class="title">Sign Out</span>
                        
                    </a>
                </li>
                <li>
                    <a href="../../index.php">
                        <span class="icon"><ion-icon name="earth-outline"></ion-icon></span>
                        <span class="title">Website</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- main -->
        <div class="main">
            <div class="topbar">
                <div class="toggle"><ion-icon name="menu-outline"></ion-icon></div>
                <!-- Search -->
                <div class="search">
                    <label for="search">
                    <form action="">
                         <input type="search"
                        
                          name="search search_text" 
                          id="search_text"  
                          placeholder="Search for Post... Name,Title , Date">
                            <ion-icon  style="margin-top: 8px;" name="search-outline"></ion-icon>
                    </form>
                    <script type='text/javascript' src="../../js/search_post.js"></script>
                    </label>
                </div>
                
                <!-- user -->
                <div class="user">
                    <img src="../css/person.png" alt="" srcset="">
                </div>

            </div>

            <!-- Cards -->
            <div class="cardBox">
                 <!-- card -->
                 <div class="card">
                    <div>
                        <div class="numbers">
                            <?php 
                            if(isset($posts_number))
                            echo $posts_number 
                            ?>
                        </div>
                        <div class="cardName">Posts</div>
                    </div>
                    <div class="iconBx">
                    <ion-icon name="apps-outline"></ion-icon>
                    </div>
                </div>
                 <!-- card -->
                 <div class="card">
                    <div>
                        <div class="numbers">
                        <?php 
                            if(isset($number_comments))
                            echo $number_comments 
                            ?>
                        </div>
                        <div class="cardName">Comment</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>
                <!-- card -->
                <div class="card">
                    <div>
                        <div class="numbers">
                        <?php 
                            if(isset($number_categories))
                            echo $number_categories 
                            ?>
                        </div>
                        <div class="cardName">Category</div>
                    </div>
                    <div class="iconBx">
                    <ion-icon name="ellipsis-vertical-outline"></ion-icon>
                    </div>
                </div>
                 <!-- card -->
                 <div class="card">
                    <div>
                        <div class="numbers">
                            <?php 
                                if(isset($number_message))
                                echo $number_message 
                            ?>
                        </div>
                        <div class="cardName">Message</div>
                    </div>
                    <div class="iconBx">
                    <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                    </div>
                </div>
            </div>

            