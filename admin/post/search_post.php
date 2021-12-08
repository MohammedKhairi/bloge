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
    <table class="table" style="width: 100%;" >
    <tr class="tr_border">
        <th class="th_top">Post Image </th>
        <th class="th_top">Post Title </th>
        <th class="th_top">Post Date </th>
        <th class="th_top">Update</th>
    </tr>';
    /////get data///////
    while($post = $posts->fetch_assoc())
    {
        $output.='
        <tr class="tr_border">
        <th class="th_center"><img src="../../img/posts/'.$post['p_img'].'" width="50px" height="50px" style="margin-top: 7px;"></th>
        <th class="th_center">'.$post['p_title'].'</th>
        <th class="th_center"style="padding: 10px 0px;">'.date('M d,Y',strtotime($post['p_date'])).'</th>
        <th class="th_center">
        <a class="btn_edit" href="update.php?p='.$post['p_id'].'&type=edit">Edite</a>
        <a class="btn_delete" href="update.php?p='.$post['p_id'].'&type=delete">Delete</a>
        </th>
    <tr>
        
        ';
    
    }
    $output.='
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
        