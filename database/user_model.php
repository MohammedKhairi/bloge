<?php

//check if the account is found
function check_user($conn,$username)
{
    $sql = "SELECT *
        FROM users
        WHERE u_username='$username' 
        ";
        
        $result = $conn->query($sql);
        //echo $result->num_rows ;exit;
        if($result->num_rows>0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
}
//insert user data
function insert_user($conn,$name,$username,$password,$email)
{
    $sql = "INSERT INTO users (u_name,u_username,u_password,u_email)
    VALUES (
        '$name','$username','$password','$email'
    )";

  //  echo $sql ; exit;

    if ($conn->query($sql) === TRUE) 
    {
       return 1;
    } 
    else 
    {
        return 0;
    }
}


//check if the account is found
function check_user_login($conn,$username,$password)
{
    $sql = "SELECT *
        FROM users
        WHERE u_username='$username' AND  u_password='$password' 
        ";
        //echo $sql;exit;
        $result = $conn->query($sql);
        //print_r($result) ;exit;
        if($result->num_rows>0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
}

//return user info for session
function user_info($conn,$username,$password)
{
    $sql = "SELECT *
        FROM users
        WHERE u_username='$username' AND  u_password='$password' 
        ";
        //echo $sql;exit;
        $result = $conn->query($sql);
        //print_r($result) ;exit;
         
        return $result;
}
function update_user_info($conn,$type,$new_data,$id)
{
    $sql = "UPDATE users SET 
            ".$type."='$new_data'
            WHERE u_id='$id'
        ";
        //echo $sql;exit;
        $result = $conn->query($sql);
        //print_r($result) ;exit;
        if($result)
        {
            return 1;
        }
        else
        {
            return 0;
        }
}
?>