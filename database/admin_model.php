<?php

//check if the admin account is found
function check_admin_login($conn,$username,$password)
{
    $sql = "SELECT *
        FROM users
        WHERE u_username='$username' AND  u_password='$password' AND u_state='1' 
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
function check_admin_username($conn,$username)
{
    $sql = "SELECT *
        FROM users
        WHERE u_username='$username'
        ";
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

//return admin info for session
function admin_info($conn,$username,$password)
{
    $sql = "SELECT *
        FROM users
        WHERE u_username='$username' AND  u_password='$password' AND u_state='1'
        ";
        //echo $sql;exit;
        $result = $conn->query($sql);
        //print_r($result) ;exit;
         
        return $result;
}

//update admin info
function update_user_info($conn,$item,$new_data,$id)
{
    $sql = "UPDATE users SET 
            $item='$new_data'
            WHERE u_id='$id' AND u_state='1'
        ";
       // echo $sql;exit;
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