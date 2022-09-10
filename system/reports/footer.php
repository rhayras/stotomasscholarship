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
    $('#reporttype').on('change',function(){
        var reporttype = $(this).val();
        if(reporttype == 1)
        {
            $('#examResultDiv').hide();
            $('#grantDiv').hide();
            $('#graduateDiv').hide();
            $('#declineDiv').hide();
            $('#scholarlistDiv').show();
        }
        else if(reporttype == 0)
        {
            $('#scholarlistDiv').hide();
            $('#grantDiv').hide();
            $('#graduateDiv').hide();
            $('#declineDiv').hide();
            $('#examResultDiv').show();
        }
        else if(reporttype == 2)
        {
            $('#scholarlistDiv').hide();
            $('#examResultDiv').hide();
            $('#graduateDiv').hide();
            $('#declineDiv').hide();
            $('#grantDiv').show();
        } 
        else if(reporttype == 3)
        {
            $('#scholarlistDiv').hide();
            $('#examResultDiv').hide();
            $('#grantDiv').hide();
            $('#declineDiv').hide();
            $('#graduateDiv').show();
        } 
        else if(reporttype == 4)
        {
            $('#scholarlistDiv').hide();
            $('#examResultDiv').hide();
            $('#grantDiv').hide();
            $('#graduateDiv').hide();
            $('#declineDiv').show();
        } 
    })
  })
</script>