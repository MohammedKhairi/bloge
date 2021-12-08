<?php
//inser comment to post 
function insert_comment($conn,$p_id,$co_name,$co_content)
{
    $sql = "INSERT INTO comments (co_p_id,co_name,co_content,co_state)
    VALUES (
    '$p_id','$co_name','$co_content','0'
    )";
    // /echo $sql;exit;
    if ($conn->query($sql) === TRUE) 
    {
       return 1;
    } 
    else 
    {
        return 0;
    }
}

//select_comment_post
function select_comment_post($item,$conn,$p_id)
{
    $sql = "SELECT ".$item.
    " FROM comments
      INNER JOIN posts ON posts.p_id = comments.co_p_id
      WHERE posts.p_id= $p_id 
      ORDER BY co_id DESC
    ";
    
    $result = $conn->query($sql);
    return $result;
}
/////////////////[admin]/////////////
//select_comment_post
function select_all_comment($conn,$item)
{
    $sql = "SELECT ".$item.
    " FROM comments
      INNER JOIN posts ON posts.p_id = comments.co_p_id 
      WHERE comments.co_state=0 
      ORDER BY co_id DESC
    ";
    $result = $conn->query($sql);
    return $result;
}
// delete one comment
 function  delete_one_comment($conn,$id)
 {
    $sql = "DELETE FROM comments  WHERE co_id=$id ";
    $result = $conn->query($sql);
    //echo $sql2;exit;
    if ($result)
    {
        return 1;
    }
     else
    {
         return 0;
    } 
 }
 //select one comment 
function select_one_comment($item,$conn,$id)
{
    $sql = "SELECT ".$item.
    " FROM comments
      INNER JOIN posts ON posts.p_id = comments.co_p_id
      WHERE comments.co_id= $id AND comments.co_state=0
    ";
    $result = $conn->query($sql);
    //echo $sql;exit;
    return $result;
}
//erplay comment and update the state of the comment
function replay_comment($conn,$content,$id)
{
    $sql = "INSERT INTO replay_c (r_c_id,r_content)
    VALUES (
    '$id','$content'
    )";
    $sql2 = "UPDATE comments SET 
         co_state='1'
    WHERE co_id='$id'
    ";
   // echo  $sql .'++++'.$sql2;exit;
    // /echo $sql;exit;
    $r1=$conn->query($sql);
    $r2=$conn->query($sql2);
    if ($r1 === TRUE &&$r2 === TRUE) 
    {
       return 1;
    } 
    else 
    {
        return 0;
    }
}

//get reply of the comment in post page for each comment
function get_reply_comment($conn,$id)
{
    $sql = "SELECT replay_c.r_content
      FROM comments
      INNER JOIN replay_c ON replay_c.r_c_id = comments.co_id
      WHERE replay_c.r_c_id = $id AND comments.co_state=1
    ";
     //echo $sql;exit;
    $result = $conn->query($sql);
   // print_r($result);exit;
    if ($result->num_rows>0)
    {
         $rep=$result->fetch_assoc();
         echo'
            <p style="font-family: tahoma;
            font-size: 14px;
            background: #343a40;
            color: #fff;
            width: 90%;
            padding: 10px 5px;
            border-radius: 5px;">
            <span style="color:#ee4266;">Admin : </span>'.$rep['r_content'].'</p>
         
         ';
         
    }
    else
    {
        echo'';
    }

}


?>