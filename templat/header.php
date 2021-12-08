<?php
//user information from the session 
session_start();
if(isset($_SESSION['u_id'],$_SESSION['name'],$_SESSION['uname'], $_SESSION['upass'],$_SESSION['email']))
{
    // echo'id  '. $_SESSION['u_id'].'<br>';
    // echo'name  '. $_SESSION['name'].'<br>';
    // echo'uname  '. $_SESSION['uname'].'<br>';
    // echo'upass  '. $_SESSION['upass'].'<br>';
    // echo'email  '. $_SESSION['email'].'<br>';
}

?>

<?php 
    //////////all data //////////////
    include('database/config.php');
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    include_once('database/category_model.php');
    //category data
    $categories =select_categories($conn);
    $cate_c=select_categories($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--JQuery version-->
	<script src="js/jquery-3.4.1.min.js"></script>
    <script type='text/javascript' src="js/dark.js"></script>
    
    <title>Document</title>
</head>
<body id="body_id">

<div class="contener">
    <!-- HEDER -->
    <header class="nav">
        <!-- HEDER TOP -->
        <div class="nav_top">
            <div class="nav_top_cont">
                <div class="socheal_mead">
                    <ul>
                        <li ><a href="#" class="fa fa-facebook"></a></li>
                        <li ><a href="#" class="fa fa-google-plus"></a></li>
                        <li ><a href="#" class="fa fa-twitter"></a></li>
                        <li ><a href="https://www.youtube.com/channel/UCg0Tx0SpESzhwgtObzp6p1Q" class="fa fa-youtube"></a></li>
                    </ul>
                </div>
                <div class="logo">
                    <img src="css/img/logo.png" alt="" srcset="" style="width:220px;">
                </div>
                <div class="option">
                    <ul>
                        <?php
                         if(isset($_SESSION['w_mode']))
                         {

                         }
                         else
                         {
                            $_SESSION['w_mode']="defult";
                         }
                        echo'<li onclick="chang_to_defult();" id="defult" style=" background: #28a745;">defult Mode</li>';
                        echo'<li onclick="chang_to_dark();" id="dark" style=" background: #3B5998;">Dark Mode</li>';

                        ?>
                        
                        
                         
                        <li ><a href="#" class="fa fa-search" onclick="show_search();"></a></li>
                        <li ><a href="#" class="fa fa-bars" onclick="show_menue();"></a></li>                
                       
                        
                    </ul>
                </div>
            </div>
        </div>
        <div id="modey">
                                
         </div>
        <!-- HEDER TOP -->

        <!-- HEDER BOTTOM -->
        <div class="nav_bottom">
            <div class="nav_bottom_cont">
                <ul>
                <li><a href="index.php" id="home">Home</a></li>
                <?php 
                    // print  data
                        if ($categories->num_rows > 0)
                        {
                            // output data of each row
                            while($row = $categories->fetch_assoc())
                            {
                                echo'
                                <li><a class="nav_dr nav_df" href="category.php?cate='.$row["c_id"].'"'.' id="'.$row["c_title"].'">'.$row["c_title"].'</a></li>
                                ';
                            }
                        }
       
                ?>
                </ul>
            </div>
        </div>
        <!-- HEDER BOTTOM -->
    </header>
    <!-- HEDER -->

<br>
<br>
<!-- ####################################### -->
<!-- search -->
 
<div class="active" id="nav_search" >
    <form action="">
        <input type="text" name="search search_text" id="search_text" placeholder="Enter your search...">
    </form>
    <button class="nav_close close_search" onclick="hid_search();">
        <span></span>
    </button>
    <br>
    <br>
    <div id="result">
       
    </div>
  <script type='text/javascript' src="js/search_post.js"></script>
    
</div>
<!--  / search -->


<!-- ####################################### -->
<!-- ####################################### -->
<!--   nav_sid -->
<div id="nav_side" class="active">
    <ul class="nav_side_menue">
        <li>
            <a href="index.php" class="has_dropdown" onclick="show_category();">CATEGORIES</a>
            <ul class="dropdown" style="list-style: none;" id="pp_category">
            <li><a href="index.php" >Home</a></li>
            <?php 
                // print  data
                    // output data of each row
                    while($rowcc = $cate_c->fetch_assoc())
                    {
                        echo'
                        <li><a href="category.php?cate='.$rowcc["c_id"].'" >'.$rowcc["c_title"].'</a></li>
                        ';
                    
                    }    
            ?>
            </ul>
        </li>   
        <?php
        if(isset($_SESSION['u_id']))
        {
            if(!$_SESSION['u_id']==NULL)
            {
                echo'<li><a href="user/profile.php">PROFILE</a></li>';
                echo'<li><a href="user/logout.php">LOG OUT</a></li>';
            }
        }
        else
        {
            echo'<li><a href="user/login.php">LOG IN</a></li>';
            echo'<li><a href="user/register.php">REGISTER</a></li>';
        }
        
        
        ?>
    </ul>
    <button class="nav_close close_search" onclick="hid_menue();">
            <span></span>
    </button>
</div>
<!--  / nav_sid -->

<!-- ####################################### -->
 <!-- LOG IN PAGE -->

 <!-- / LOG IN PAGE -->
<!-- ####################################### -->