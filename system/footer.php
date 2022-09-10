
  <!-- JavaScript Libraries -->
  <script src="../lib/jquery/jquery.min.js"></script>
  <script src="../lib/jquery/jquery-migrate.min.js"></script>
  <script src="../lib/popper/popper.min.js"></script>
  <script src="../lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="../lib/easing/easing.min.js"></script>
  <script src="../lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="../lib/scrollreveal/scrollreveal.min.js"></script>
  <!-- Contact Form JavaScript File -->

  <!-- Template Main Javascript File -->
  <script src="../js/main.js"></script>
  <script>
    var privilege = "<?php echo $_SESSION['priviledge']?>";
    //new applicant notif
    function applyNotif()
    {
         $.ajax({
            url     : '../php/newapplicantNotif.php',
            success : function(data)
            {
              $(".applicantnotif").html(data);
              console.log(data);
            }
        })
    }
    applyNotif();
    setInterval(function(){ 
      applyNotif();
    }, 5000);

    //new renewal notif
    function reapplyNotif()
    {
        $.ajax({
            url     : '../php/newrenewalNotif.php',
            success : function(data)
            {
              $(".renewalBadge").html(data);
              console.log(data);
            }
        })
    }
    reapplyNotif();
    setInterval(function(){ 
      reapplyNotif();
    }, 5000);

        //new chat notif
    function chatNotif()
    {
         $.ajax({
            url     : '../php/chatNotif.php',
            success : function(data)
            {
              $(".chatNotif").html(data);
              console.log(data);
            }
        })
    }
    chatNotif();
    setInterval(function(){ 
      chatNotif();
    }, 5000);
  </script>
  <script>
    $(document).ready(function(){
        $.ajax({
            url     :   '../php/calendar.php',
            success :   function(data)
            {
                $('#companyCalendar').html(data);
            }
        });
    });
</script>
</body>
</html>