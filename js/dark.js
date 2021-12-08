
      
       function chang_to_dark()
       {
        const bg=document.getElementById('body_id');
         //for #fff color
           const chang = [".nav_bottom_cont ul li a","label.txtx",".newsletter_widget form p","h3.p_title a","a.pa_num","h3.p__title","p.post_content",".B_content ul li a"];
         //for anthor color
         const chang2 = ["h3.p__title","h3.footer_title"];
        
           bg.style.background='#1b1c1e';
           //change data
           for (let i = 0; i < chang.length; i++) {
             $(chang[i]).addClass('dark_mode');
           }
           for (let i = 0; i < chang2.length; i++) {
            $(chang2[i]).addClass('dark_mode2');
          }
          $(".section_title .title").addClass('dark_mode3');
          $(".socheal_mead ul li a").addClass('dark_mode3');
          $(".option ul li a").addClass('dark_mode3');
          document.getElementById('fo_footer').style.borderTop ='1px solid #d8d8d8';
          query="dark";
          $.ajax({
            url:'change.php',
            method:"POST",
            data:{query:query},
            success:function(data){
             $('#modey').html(data);
            }
           })
            //location.reload();
        

       };
       function chang_to_defult()
       {
        const bg=document.getElementById('body_id');
        //for #fff color
          const chang = [".nav_bottom_cont ul li a","label.txtx",".newsletter_widget form p","h3.p_title a","a.pa_num","h3.p__title","p.post_content",".B_content ul li a"];
        //for anthor color
        const chang2 = ["h3.p__title","h3.footer_title"];
           bg.style.background='#d8d8d8';

           for (let i = 0; i < chang.length; i++) {
            $(chang[i]).removeClass('dark_mode');
           }
           for (let i = 0; i < chang2.length; i++) {
            $(chang2[i]).removeClass('dark_mode2');
           }
          $(".section_title .title").removeClass('dark_mode3');
          $(".socheal_mead ul li a").removeClass('dark_mode3');
          $(".option ul li a").removeClass('dark_mode3');
          query="defult";
          $.ajax({
            url:'change.php',
            method:"POST",
            data:{query:query},
            success:function(data){
             $('#modey').html(data);
            }
           })
           // location.reload();


    
       };



      //  const bg=document.getElementById("body_id");
      //  const dark=document.getElementById("dark");
      //  const defult=document.getElementById("defult");
      //  //for #fff color
      //  const chang = [".nav_bottom_cont ul li a","label.txtx",".newsletter_widget form p","h3.p_title a","a.pa_num","h3.p__title","p.post_content",".B_content ul li a"];
      //  //for anthor color
      //  const chang2 = ["h3.p__title","h3.footer_title"];
      //  bg.style.background="#1b1c1e";                                        

      //      //change data
      //      for (let i = 0; i < chang.length; i++) {
      //          $(chang[i]).removeClass("dark_mode");
      //      }
      //      for (let i = 0; i < chang2.length; i++) {
      //          $(chang2[i]).removeClass("dark_mode2");
      //      }
      //      $(".section_title .title").removeClass("dark_mode3");
      //      $(".section_title .title").addClass("dark_mode3");
      //      query="defult";
      //      $.ajax({
      //          url:"change.php",
      //          method:"POST",
      //          data:{query:query},
      //          success:function(data){
      //          $("#modey").html(data);
      //          }
         //  })