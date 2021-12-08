<?php
    //home page select post
    function select_posts($item,$tb_name,$conn,$page)
    {
        $post_per_page=5;
        $limit_page=($page-1)*$post_per_page;

        $sql = "SELECT".$item.
        "FROM ".$tb_name.
        " INNER JOIN category ON posts.p_c_id = category.c_id ORDER BY p_id DESC ".
        "LIMIT ".$limit_page.", ".$post_per_page."";
        $result = $conn->query($sql);
        return $result;
    }  
    //// home page get number of posts
    function num_posts($item,$conn)
    {
        $sql = "SELECT ".$item.
        " FROM posts
        INNER JOIN category ON posts.p_c_id = category.c_id ORDER BY p_id DESC";
        $result = $conn->query($sql);
        return $result->num_rows;

    }
    //check post if found
    function check_post($conn,$p_id)
    {
        $sql = "SELECT *
        FROM posts
        WHERE p_id=$p_id 
        ";
        
        $result = $conn->query($sql);

        if($result->num_rows>0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    //get one post
    function select_one_post($item,$conn,$p_id)
    {
        $sql = "SELECT ".$item.
        " FROM posts
        INNER JOIN category ON posts.p_c_id = category.c_id
        WHERE posts.p_id=$p_id 
        ";
        
        $result = $conn->query($sql);
        return $result;
    } 
    //select_comment_post
    function search_on_post($item,$conn,$query)
    {
        $sql = "SELECT ".$item.
        " FROM posts
          INNER JOIN category ON posts.p_c_id = category.c_id
          WHERE posts.p_title LIKE '$query%' OR 
          p_date LIKE '$query%'
        ";
        //echo $sql;
        
        $result = $conn->query($sql);
        return $result;
    }
     //select_three_releted_post
     function select_three_r_post($item,$conn,$p_id,$c_id)
     {
         $sql = "SELECT ".$item.
         " FROM posts
           INNER JOIN category ON posts.p_c_id = category.c_id
           WHERE category.c_id = $c_id AND posts.p_id != $p_id  
           ORDER BY posts.p_id DESC
           LIMIT 0,3
         ";
         
         $result = $conn->query($sql);
         return $result;
     }
     //
     function select_all_post($conn,$item)
    {
        $sql = "SELECT ".$item.
        " FROM posts ORDER BY p_id DESC 
          LIMIT 10 ";
        $result = $conn->query($sql);
        return $result;
    }  
    //select_comment_post
    function search_for_post($item,$conn,$query)
    {
        $sql = "SELECT ".$item.
        " FROM posts
          WHERE p_title LIKE '$query%' OR 
           p_date LIKE '$query%'
        ";
       //    / echo $sql;exit;
        
        $result = $conn->query($sql);
        return $result;
    }
    ///////////admin
    function add_post($conn,$title,$content,$category,$tage,$img)
    {
        $sql = "INSERT INTO posts (p_title,p_content,p_img,p_c_id,p_tags,p_c_active)
        VALUES (
            '$title','$content','$img','$category','$tage','1'
        )";
         //echo $img;exit;
        if ($conn->query($sql) === TRUE) 
        {
        return 1;
        } 
        else 
        {
            return 0;
        }
    }
    
    //delete post
    function delete_one_post($conn,$id)
    {
        $sql = "DELETE FROM posts  WHERE p_id=$id ";
        $sql2 = "SELECT p_img FROM posts  WHERE p_id=$id ";
        $result = $conn->query($sql2);
        //echo $sql2;exit;
        if ($conn->query($sql) === TRUE)
        {
            //Record deleted successfully
            //delete img from the folder
            if ($result)
            {
                $cate2 = $result->fetch_assoc();
                //delete img file
                $filename ="../../img/posts/".$cate2['p_img'];
                //$filename ="../../img/category/android.jpg";
                //echo $filename;exit;

                if (file_exists($filename)) {
                    unlink($filename);
                    return 1;
                    exit;
                }
                 else
                  {
                    return 0;
                    exit;

                }

            }
        }
         else
        {
             return 0;
        } 
    }
     //get one post
     function one_post($item,$conn,$p_id)
     {
         $sql = "SELECT ".$item.
         " FROM posts
            WHERE p_id=$p_id 
         ";
         
         $result = $conn->query($sql);
         return $result;
     }
     //update record[title, category tags content]
     // update category name img
    function update_record($conn,$record,$value,$id)
    {
        $sql = "UPDATE posts SET 
            $record ='$value'
        WHERE p_id='$id'
        ";
        if ($conn->query($sql) === TRUE) 
        {
           return 1;
        } 
        else 
        {
            return 0;

        }
    }

    //delete image
    function delete_image_post($conn,$id)
    {
        $sql = "SELECT p_img FROM posts  WHERE p_id=$id ";
        $result = $conn->query($sql);
      //  echo $sql;exit;
        if ($result)
        {
            //Record deleted successfully
            //delete img from the folder
                $postx = $result->fetch_assoc();
                //delete img file
                $filename ="../../img/posts/".$postx['p_img'];
                //$filename ="../../img/category/android.jpg";
                //echo $filename;exit;

                if (file_exists($filename))
                {
                    unlink($filename);
                  //  echo $filename;exit;
                    return 1;
                    
                }
                else
                {
                    return 0;

                }
        }
         else
        {
             return 0;
        } 

    }

?>