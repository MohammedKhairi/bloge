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
     include_once('../../database/config.php');
    // Check connection
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    include_once('../../database/post_model.php');
    $posts=search_for_post('p_id,p_title,p_img,p_date',$conn,$query);
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
    while($post = $posts->fetch_assoc())
    {
        $output.='
        <tr>
            <td width="60px">
                <div class="imgBx"><img src="../../img/posts/'.$post['p_img'].'" alt=""></div>
            </td>
            
           <td>
                '.$post['p_title'].'
           </td>

            <td>
            '.date('M d,Y',strtotime($post['p_date'])).'
            </td>
            <td>
                <a href="update.php?p='.$post['p_id'].'&type=edit"><span class="status delivered">Edit</span></a>
                <a  href="update.php?p='.$post['p_id'].'&type=delete"><span class="status return">Delete</span></a>
            </td>
		</tr>   
        ';
    
    }
    $output.='
    </tbody>
    </table>
    ';
    echo $output;
  }
  else
  {
    echo '';
    exit;
  }
  
  
  
  ?>      
        