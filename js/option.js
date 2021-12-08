const b_value =document.getElementById('b_value');
const p_list=document.getElementById('list');

const b_value2 =document.getElementById('b_value2');
const p_list2=document.getElementById('list2');

function show_option()
{
    p_list.style.display='block';
}
function get_value($var)
{
    b_value.value=$var;
    p_list.style.display='none';
    //alert('ok'+$var);
}

function show_option2()
{
   // b_value2.value='';
    p_list2.style.display='block';
}

function get_value2($var) 
{
    //alert('ok');
    //alert($var);
    b_value2.value=$var+' '+b_value2.value;
    p_list2.style.display='none';
    //alert('ok'+$var);
}