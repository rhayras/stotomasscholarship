  <!--/ footer Star /-->
  <section class="section-footer">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-4">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">EPS Scholarship</h3>
            </div>
            <div class="w-body-a">
              <p class="w-text-a color-text-a">
                Education People Service. Scholarship Program for all Tomasino.
              </p>
            </div>
            <div class="w-footer-a">
              <ul class="list-unstyled">
                <li class="color-a">
                  <span class="color-text-a">Phone .</span> (043) 405 9942</li>
                <li class="color-a">
                  <span class="color-text-a">Email .</span> scholarship.mstb@gmail.com</li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4 section-md-t3">
          <div class="widget-a">
            <div class="w-header-a">
              <h3 class="w-title-a text-brand">Usable Links</h3>
            </div>
            <div class="w-body-a">
              <div class="w-body-a">
                <ul class="list-unstyled">
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="index.php">Home</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="about.php">About</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="applicantform.php">Apply as Scholar</a>
                  </li>
                  <li class="item-list-a">
                    <i class="fa fa-angle-right"></i> <a href="#"  data-toggle="modal" data-target="#loginModal">Signin</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <footer>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <nav class="nav-footer">
            <ul class="list-inline">
              <li class="list-inline-item">
                <a href="index.php">Home</a>
              </li>
              <li class="list-inline-item">
                <a href="about.php">About</a>
              </li>
              <li class="list-inline-item">
                <a href="applicantform.php">Apply as Scholar</a>
              </li>
              <li class="list-inline-item">
                <a href="#"  data-toggle="modal" data-target="#loginModal">Signin</a>
              </li>
            </ul>
          </nav>
         
          <div class="copyright-footer">
            <p class="copyright color-text-a">
              &copy; Copyright
              <span class="color-a">EPS Scholarship</span> All Rights Reserved.
            </p>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!--/ Footer End /-->

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
                                      swal("Authentication Failed",data, "error")
                                     
                                  }
                                }
            })
        }
     })
  })
</script>