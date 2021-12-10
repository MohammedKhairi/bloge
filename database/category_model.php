<?php
    // home page select categories
    function select_categories($conn)
    {
        $sql = "SELECT c_title , c_id , COUNT(posts.p_id) AS number_c 
        FROM category
        INNER JOIN posts
        ON category.c_id = posts.p_c_id  GROUP BY (posts.p_c_id) ";
        $result = $conn->query($sql);
        return $result;
    } 
    //get number of post in one category
    function num_posts_category($item,$conn,$cate_id)
    {
        $sql = "SELECT ".$item."
        FROM posts
        INNER JOIN category ON posts.p_c_id = category.c_id 
        WHERE category.c_id=$cate_id 
        ORDER BY posts.p_id DESC ";
        //echo $sql;exit;
        $result = $conn->query($sql);
        return $result->num_rows;
    }
    //get all post in one category
    function posts_in_category($item,$conn,$cate_id,$page)
    {
        $post_per_page=5;
        $limit_page=($page-1)*$post_per_page;
        $sql = "SELECT ".$item."
          FROM posts
          INNER JOIN category ON posts.p_c_id = category.c_id 
          WHERE category.c_id=$cate_id 
          ORDER BY posts.p_id DESC
          LIMIT ".$limit_page.", ".$post_per_page."";
        //echo $sql;exit;
        $result = $conn->query($sql);
        return $result;
    }
    
    // get one category info
    function select_one_category($item,$conn,$cate_id)
    {
        $sql = "SELECT ".$item."
          FROM category
          WHERE c_id=$cate_id 
          ";
        //echo $sql;exit;
        $result = $conn->query($sql);
        return $result;
    }
    ///////////////[admin]//////////////
    function select_all_categories($conn)
    {
        $sql = "SELECT c_title , c_id ,c_img 
        FROM category";
        $result = $conn->query($sql);
        return $result;
    } 
    //delete category
    function delete_one_categories($conn,$id)
    {
        $sql = "DELETE FROM category  WHERE c_id=$id ";
        $sql2 = "SELECT c_img FROM category  WHERE c_id=$id ";
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
                $filename ="../../img/category/".$cate2['c_img'];
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
    //add category
    function add_category($conn,$title,$img)
    {
        $sql = "INSERT INTO category (c_title,c_img)
        VALUES (
        '$title','$img'
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
    // update category name
    function update_name($conn,$name,$id)
    {
        $sql = "UPDATE category SET 
            c_title='$name'
        WHERE c_id='$id'
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
    function delete_image($conn,$id)
    {
        $sql = "SELECT c_img FROM category  WHERE c_id=$id ";
        $result = $conn->query($sql);
      //  echo $sql;exit;
        if ($result)
        {
            //Record deleted successfully
            //delete img from the folder
                $cate = $result->fetch_assoc();
                //delete img file
                $filename ="../../img/category/".$cate['c_img'];
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
    //update img
    function update_image($conn,$id,$img)
    {
        $sql = "UPDATE category SET 
            c_img='$img'
        WHERE c_id='$id'
        ";
       // echo $sql;exit;
        if ($conn->query($sql) === TRUE) 
        {
           // echo 'yes';exit;
           return 1;
        } 
        else 
        {
            //echo 'no';exit;
            return 0;

        }
    }

?>