    <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="../../lib/jquery/jquery.min.js"></script>
  <script src="../../lib/jquery/jquery-migrate.min.js"></script>
  <script src="../../lib/popper/popper.min.js"></script>
  <script src="../../lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="../../lib/easing/easing.min.js"></script>
  <script src="../../lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../../lib/scrollreveal/scrollreveal.min.js"></script>
  <!-- Contact Form JavaScript File -->
   <script src="../../js/sweetalert.min.js"></script>
   <script src="../../js/jquery.nicescroll.js"></script>

  <!-- Template Main Javascript File -->
  <script src="../../js/main.js"></script>
  <script>
  $("#convoAdmin").niceScroll({
      cursorwidth: '0px', 
      cursorfixedheight: 70,
      autohidemode: true, 
      zindex: 999,
      cursorcolor: 'gainsboro'
  });
  $(".divContainer").niceScroll({
      cursorwidth: '7px', 
      cursorfixedheight: 70,
      autohidemode: true, 
      zindex: 999,
      cursorcolor: '#007E33'
  });

    $("#message").niceScroll({
      cursorwidth: '7px', 
      cursorfixedheight: 70,
      autohidemode: true, 
      zindex: 999,
      cursorcolor: 'white'
  });
</script>
</body>
<script>
        function adminConvo()
      {
        var senderId = 'admin';//admin
        var receiver = $("#receiver").val();//student
        $.ajax({
          url     : 'displayconvo.php',
          method  : 'POST',
          data    : {senderId:senderId,receiver:receiver},
          success : function(data)
          {
            console.log(data);
            $('#convoAdmin').html(data);
          }
        })
      }
         adminConvo();
     setInterval(function() {
      adminConvo();
       }, 2000);

    $(document).ready(function(){
       $(".individual").click(function(){
          var studentId = $(this).attr("studentId");
          $.ajax({
              url     : 'updateChatStatus.php',
              method  : 'POST',
              data    :  {studentId:studentId},
              success : function(data)
              {
                $('.myChatNotif').html();
              }
          })
          $("#receiver").val(studentId);
          $(".individual").removeClass("active");
          $('.container'+studentId).addClass("active");

          $("#studentName").html($(this).attr("studentName"));
          adminConvo();
          $('#convoAdmin').animate({scrollTop: $('#convoAdmin').get(0).scrollHeight}, 1000);
       })

       $('#adminChatForm').on('submit', function(event){
           event.preventDefault();
           var formdata = $(this).serialize();
           $.ajax({
              url     :   'saveChat.php',
              method  :   'POST',
              data    :   formdata,
              success :   function(data)
              {
                  $('#adminChatForm')[0].reset();
                  $('#convoAdmin').animate({scrollTop: $('#convoAdmin').get(0).scrollHeight}, 1000);
              }
           })
       })

       $('#message').on('focus',function(){
          $('#convoAdmin').animate({scrollTop: $('#convoAdmin').get(0).scrollHeight}, 1000);
       })
    })
  </script>
</html>

