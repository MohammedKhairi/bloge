var form=document.getElementById('form_u');

function name_u() 
{ 
    form.innerHTML+='<form action ="update.php?type=name" method="post"><div class="form-group"><label for="email">New Name </label><input  type="text" name="name" class="input" id="name" placeholder="Pless Enter New Name"></div><div class="form-group"><button type="submit" style="float: left; "  id="button" class="primary_button"> Update</button></div></form><br><br><br>';
    
 }
 function uname_u() 
{ 
    form.innerHTML+='<form action ="update.php?type=username" method="post"><div class="form-group"><label for="email">New UserName </label><input  type="text" name="uname" class="input" id="uname" placeholder="Pless Enter New UserName"></div><div class="form-group"><button type="submit" style="float: left; "  id="button" class="primary_button"> Update</button></div></form><br><br><br>';

    
 }
 function pass_u() 
{ 
    form.innerHTML+='<form action ="update.php?type=password" method="post"><div class="form-group"><label for="email">New Password </label><input  type="password" name="upass" class="input" id="upass" placeholder="Pless Enter New Password"></div><div class="form-group"><button type="submit" style="float: left; "  id="button" class="primary_button"> Update</button></div></form><br><br><br>';
    
 }
 function email_u() 
 { 
    form.innerHTML+='<form action ="update.php?type=email" method="post"><div class="form-group"><label for="email">New Email </label><input  type="email" name="email" class="input" id="email" placeholder="Pless Enter New Email"></div><div class="form-group"><button type="submit" style="float: left; "  id="button" class="primary_button"> Update</button></div></form><br><br><br>';
     
  }
