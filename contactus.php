<?php include_once('templat/header.php');?>
<br>
<br>
<!-- ####################################### -->

<!-- web content -->
<div class="web_content">
<!-- website all post section -->
    <div class="web_post">
    
<div class="txt_p">
<br>
<p>
   send us message 
</p>
<p>
   Ypu need to Login or Register 
</p>

<br>
<br>
</div>
<div class="rec">
  </div>

  <br><br>
  <form action="user/message.php" method="post">
      <input type="text" name="name" class="input" placeholder="Enter Your Name">
      <br>
      <label for="w3review">Enter Your Message :</label>
      <textarea name="content" class="inputs" rows="4" cols="50">
      </textarea>
      <button class="primary_button" name="submit" type="submit">
         SEND
      </button>
   </form>
<?php include_once('templat/block.php');?>
<?php include_once('templat/footer.php');?>