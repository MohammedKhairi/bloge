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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Controll Panal</title>
    <link rel="stylesheet" href="../css/admin.css">
	<script src="../../js/jquery-3.4.1.min.js"></script>

</head>
<body>
    <div class="contener">
        <div class="nav">
            <div class="sit_name">
               <p>Bloger </p>
            </div>
            <div class="work">
                <ul>
                    <li onclick="show_panal('admin');">
                        Admin
                        <ul class="panal_c" id="admin">
                            <li><a href="../info/admin_info.php">show info</a></li>
                            <li><a href="../info/admin_edit.php">Edite info</a></li>
                        </ul>
                    </li>
                    <li onclick="show_panal('post');">
                        Post
                        <ul class="panal_c" id="post">
                            <li><a href="../post/show.php">Show Post</a></li>
                            <li><a href="../post/add.php">Add Post</a></li>
                        </ul>
                        
                    </li>
                    <li onclick="show_panal('category');">
                        Category
                        <ul class="panal_c" id="category">
                            <li><a href="../category/show.php">Show category</a></li>
                            <li><a href="../category/add.php">Add category</a></li>
                        </ul>
                    </li>
                    <li onclick="show_panal('comment');">
                        Comment
                        <ul class="panal_c" id="comment">
                            <li><a href="../comment/show.php">show comment</a></li>
                        </ul>
                        
                    </li>
                    <li onclick="show_panal('tags');">
                        Tags
                        <ul class="panal_c" id="tags">
                            <li><a href="../tags/show.php">Show Tags</a></li>
                            <li><a href="../tags/add.php">Add Tags</a></li>
                        </ul>
                        
                    </li>
                    <li onclick="show_panal('message');">
                        Message
                        <ul class="panal_c" id="message">
                            <li><a href="../message/show.php">Show Message</a></li>
                        </ul>
                        
                    </li>

                </ul>
            </div>
            <div class="operation">
                <ul>
                    <li><a href="../../index.php">WEBSITE</a></li>
                    <li><a href="../info/logout.php">LOGOUT</a></li>
                </ul>
            </div>
        </div>
        <br>
        <br>
        <div class="web_content">

