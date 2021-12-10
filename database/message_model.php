
<?php
//home page insert message for user
function insert_message($conn,$id,$name,$content)
{
    $sql = "INSERT INTO u_message (m_u_id,m_name,m_content,m_state)
    VALUES (
        '$id','$name','$content','0'
    
    )";
   // print($sql);exit;
    if ($conn->query($sql) === TRUE) 
    {
       return 1;
    } 
    else 
    {
        return 0;
    }
}

//home page insert subscrip for user
function insert_subscrip($conn,$email)
{
    $sql = "INSERT INTO subscrip (s_email)
    VALUES (
    '$email'
    )";
    if ($conn->query($sql) === TRUE) 
    {
       return 1;
    } 
    else 
    {
        return 0;
    }
}
//home page insert subscrip for user
function check_email($conn,$email)
{
    $sql = "SELECT * 
     FROM subscrip 
     WHERE s_email = '$email'
     ";
    $result = $conn->query($sql);
   // print_r($result) ;exit;

    if ($result) 
    {
        if($result->num_rows >0)
        return 1;

        else
        return 0;
    } 
    else 
    {
        return 0;
    }
}
// get all message for one user 
function get_user_message($conn,$id)
{
    $sql = "SELECT m_content,m_name,m_date,m_id,rm_content,rm_date
      FROM u_message
      LEFT JOIN users ON users.u_id = u_message.m_u_id
      LEFT JOIN replay_m ON replay_m.rm_m_id = u_message.m_id

      WHERE u_message.m_u_id = $id ORDER BY m_id DESC
    ";
    
     //echo $sql;exit;
    $result = $conn->query($sql);
   // print_r($result);exit;
    if ($result->num_rows>0)
    {
        return $result;
         
    }
    else
    {
        return 0;
    }
}
function get_user_message_replay($conn,$id)
{
    $sql = "SELECT *
      FROM replay_m
      WHERE rm_m_id = $id
    ";
    echo $sql;
    $result = $conn->query($sql);
    if($result)
      return $result;
         

}
////////////////admin////////////////
// get all message
function select_all_messages($conn)
{
    $sql = "SELECT * FROM u_message WHERE m_state=0 ORDER BY m_id DESC  ";
    $result=$conn->query($sql);
   // echo   $sql ;exit;
   // print_r($result);exit;
       return $result;
}
function delete_one_message($conn,$id)
{
    $sql = "DELETE 
     FROM u_message 
     WHERE m_id = '$id'
    ";
   $result = $conn->query($sql);
  // print_r($result) ;exit;

   if ($result) 
   {
       return 1;
   } 
   else 
   {
       return 0;
   }

}
function select_one_message($conn,$id)
{
    $sql = "SELECT * FROM u_message WHERE m_id =$id AND m_state=0";
    $result=$conn->query($sql);
   // echo   $sql ;exit;
   // print_r($result);exit;
       return $result;
}
//erplay message and update the state of the comment
function replay_message($conn,$content,$id)
{
    $sql = "INSERT INTO replay_m (rm_m_id,rm_content)
    VALUES (
    '$id','$content'
    )";
    $sql2 = "UPDATE u_message SET 
         m_state='1'
    WHERE m_id='$id'
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
//get reply of the message in post page for each comment
function get_reply__message($conn,$id)
{
    $sql = "SELECT replay_m.rm_content, replay_m.rm_date 
      FROM u_massage
      INNER JOIN replay_m ON replay_m.rm_m_id = u_message.m_id
      WHERE replay_m.rm_m_id = $id AND message.m_state=1
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
//insert subscrip for user
function get_email_subscrip($conn)
{
    $sql = "SELECT * 
     FROM subscrip 
     ";
    $result = $conn->query($sql);
    return $result;
   // print_r($result) ;exit;
}
?>