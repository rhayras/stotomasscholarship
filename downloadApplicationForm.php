<?php
include('headerNav.php');

$studentId = $_GET['studentId'];
?>

  <section class="section-services section-t8">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-wrap d-flex justify-content-between">
            <div class="title-box">
              <center><h2 class="title-a">Download Application Form</h2></center>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 col-lg-12">
          <p>You need to download your application form. Then you need to upload this form in your account as requirements.<br>
         </div>
      </div>
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <center>
             <i><a href="applicationFormPDF.php?studentId=<?php echo $studentId?>" target="_blank">Download Link</a></i><br><br>

             <a href="../stotomasscholarship" class="btn btn-success" style="color:white">Back to EPS Website</a>
          </center>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
  </section>
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
