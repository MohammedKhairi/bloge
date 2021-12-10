  <?php
  $output = '';
  $query = '';
  if(isset($_POST['query']))
  {
    $query = $_POST['query'];
    if($query==NULL)
     {
         echo '';
         exit;

     }
     include_once('database/config.php');
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    include_once('database/post_model.php');
    $post=search_on_post('p_id,p_title,p_img,c_id,c_title',$conn,$query);
    $conn->close();
    $output.='
    <table>
    <thead>
        <tr>
            <td>Image</td>
            <td>Title</td>
            <td>Date</td>
            <td>Operation</td>
        </tr>
    </thead>
    <tbody>';
    /////get data///////
    while($row_s = $post->fetch_assoc())
    {
        $output.='
        <tr>
            <td width="60px">
                <div class="imgBx"><img src="img/posts/'.$row_s['p_img'].'" alt=""></div>
            </td>

            <td>
                <a style="color:#1b1c1e;font-weight: bold;" href="post.php?p='.$row_s['p_id'].'" role="button">'.$row_s['p_title'].'</a>
            </td>
			<td>
				<a style="color:#1b1c1e;font-weight: bold;" href="category.php?cate='.$row_s['c_id'].'" role="button">'.$row_s['c_title'].'</a>
			</td>
		</tr>
        
        ';
    
    }
    $output.='
    </tbody>
    </table>
    </div>
    ';
    echo $output;
  }
  else
  {
    echo '';
    exit;
  }
  
  
  
  ?>      
        