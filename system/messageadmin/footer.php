<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
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

  <!-- Template Main Javascript File -->
  <script src="../../js/main.js"></script>


</body>
</html>
  <script src="../DataTables/datatables-real/js/jquery.dataTables.min.js"></script> 
  <script src="../DataTables/datatables-real/js/dataTables.bootstrap4.min.js"></script>
  <link rel="stylesheet" href="../DataTables/datatables-real/css/dataTables.bootstrap4.css" />  
  <script>
    $(document).ready(function(){
      $('#dataTableId').DataTable({
         "searching": false,
         "bInfo": false,
         "lengthChange": false,
         "pageLength": 5
      });

      
    })
  </script>
     <script src="../../js/jquery.nicescroll.js"></script>
  <script>
  $("#convoStudent").niceScroll({
      cursorwidth: '0px', 
      cursorfixedheight: 70,
      autohidemode: true, 
      zindex: 999,
      cursorcolor: 'gainsboro'
  });
</script>
<script>
        function studentConvo()
      {
        var senderId = '<?php echo $_SESSION['studentId']?>';//admin
        $.ajax({
          url     : 'displayconvo.php',
          method  : 'POST',
          data    : {senderId:senderId},
          success : function(data)
          {
            console.log(data);
            $('#convoStudent').html(data);
            
          }
        })
      }
         studentConvo();
     setInterval(function() {
      studentConvo();
       }, 2000);

    $(document).ready(function(){
      studentConvo();
       $('#studentChatForm').on('submit', function(event){
           event.preventDefault();
           var formdata = $(this).serialize();
           $.ajax({
              url     :   'saveChat.php',
              method  :   'POST',
              data    :   formdata,
              success :   function(data)
              {
                  $('#studentChatForm')[0].reset();
                  $('#convoStudent').animate({scrollTop: $('#convoStudent').get(0).scrollHeight}, 1000);
              }
           })
       })
    })
  </script>
