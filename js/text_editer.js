

var idoftextarea='editor';
var result=document.getElementById('editor2');
select_txt="";
var textArea = document.getElementById(idoftextarea);
//textArea.document.designMode="on";  
// Function to get the Selected Text  
function change_op(change)
 {
    var text =textArea.value;
    var indexStart=textArea.selectionStart;
    var indexEnd=textArea.selectionEnd;
    // alert(text.substring(indexStart, indexEnd));
    select_txt=text.substring(indexStart, indexEnd);
    //alert(new_value);
    if(change=="bold")
    {
       alert(change);
      new_value="<b>"+select_txt+"</b>";
    }
    result.innerHTML+=new_value;
   // textArea.document.designMode="on"; 
   //textArea.document.execCommand('bold',false,null);
} 