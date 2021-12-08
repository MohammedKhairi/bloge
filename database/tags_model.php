<?php
    //home page select tags
    function select_tags($conn)
    {

        $sql = "SELECT * 
         FROM tags
         ORDER BY t_id DESC";
        $result = $conn->query($sql);
        return $result;
    }
    //admin 
    
    //insert user data
    function add_tags($conn,$name)
    {

        $sql2 = "INSERT INTO tags (t_name)
        VALUES (
            '$name'
        )";

            if ($conn->query($sql2) === TRUE) 
            {
                return 1;
            } 
            else 
            {
                return 0;
            }          
    }

    //delete one tage
    function  delete_one_tag($conn,$id)
    {
        $sql = "DELETE FROM tags  WHERE t_id=$id ";
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
    function select_one_tag($conn,$id)
    {

        $sql = "SELECT * 
         FROM tags
         WHERE t_id=$id ";
         //echo $sql;exit;
        $result = $conn->query($sql);
        //print_r($result);exit;
        $tage=$result->fetch_assoc();
        return $tage['t_name'];
    }
    
    function update_tags($conn,$id,$name)
    {
        $sql = "UPDATE tags SET 
                t_name='$name'
                WHERE t_id='$id'
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