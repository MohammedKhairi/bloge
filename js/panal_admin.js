//alert('ok');
var panal;
function show_panal(panal)
{
    var panals = ["admin", "post", "category", "comment", "tags", "message"];
    for (let index = 0; index < panals.length; index++)
    {
        document.getElementById(panals[index]).style.display='none';
    }
  document.getElementById(panal).style.display='table-cell';
};