

function chang_to_home()
       {
           
          $(".home").addClass('active');
       };

function chang_to_cate(name)
{

    $(".home").removeClass('active');
    $("."+name).addClass('active');

};