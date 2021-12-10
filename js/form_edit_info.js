var form=document.getElementById('form_u');

function name_u() 
{ 
    form.innerHTML+='<br><form action ="update.php?type=name" method="post"><div class="form-group">><input  type="text" name="name" class="btn_input" id="name" placeholder="Pless Enter New Name"></div><br><div class="form-group"><button type="submit"   id="button" class="primary_button"> Update</button></div></form><br><br><br>';
    
 }
 function uname_u() 
{ 
    form.innerHTML+='<br><form action ="update.php?type=username" method="post"><div class="form-group"><input  type="text" name="uname" class="btn_input" id="uname" placeholder="Pless Enter New UserName"><br></div><div class="form-group"><button type="submit" style="float: left; "  id="button" class="primary_button"> Update</button></div></form><br><br><br>';

    
 }
 function pass_u() 
{ 
    form.innerHTML+='<br><form action ="update.php?type=password" method="post"><div class="form-group"><input  type="password" name="upass" class="btn_input" id="upass" placeholder="Pless Enter New Password"><br></div><div class="form-group"><button type="submit" style="float: left; "  id="button" class="primary_button"> Update</button></div></form><br><br><br>';
    
 }
 function email_u() 
 { 
    form.innerHTML+='<br><form action ="update.php?type=email" method="post"><div class="form-group"><input  type="email" name="email" class="btn_input" id="email" placeholder="Pless Enter New Email"><br></div><div class="form-group"><button type="submit" style="float: left; "  id="button" class="primary_button"> Update</button></div></form><br><br><br>';
     
  }
