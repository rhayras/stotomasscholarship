
  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
  <div id="preloader"></div>

  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/popper/popper.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/scrollreveal/scrollreveal.min.js"></script>
  <!-- Contact Form JavaScript File -->
  <script src="js/sweetalert.min.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>

</body>
</html>
<script>
  $(document).ready(function(){
    $("#cancelBtn").on('click',function(){
      $("#closeModal").click();
    })
     $('#loginForm').on('submit',function(event){
        event.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();

        if(username === "")
        {
            swal("All Fields are Required", "Enter username.", "error")
        }
        else if (password === "")
        {
           swal("All Fields are Required", "Enter password.", "error")
        }
        if(username != "" && password != "")
        {
            $.ajax({
                  url       :   'php/login.php',
                  method    :   'POST',
                  data      :   {
                                  username:username,
                                  password:password
                                },
                  success   :   function(data)
                                {
                                  if(data === "success")
                                  {
                                      window.location.href = "system/";
                                  }
                                  else
                                  {
                                      //$("#loginModal").addClass("animated shake");
                                      //$('#errormessage').html("Authentication Failed. Please try again");
                                      //$('#password').html();
                                      swal("Authentication Failed", "Please try again.", "error")
                                     
                                  }
                                }
            })
        }
     })

  })
</script>