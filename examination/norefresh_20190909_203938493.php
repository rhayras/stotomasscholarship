

<script src="/V3/Common Data/Libraries/Javascript/jQuery 3.1.1/jquery-3.1.1.js"></script>

<!--NO F5 RELOAD -->
<script src="/V3/Common Data/Libraries/Javascript/jquery-fullscreen/jquery.fullscreen-min.js"></script>
<script>
  $(function() {

    $(".fullscreen-supported").toggle($(document).fullScreen() != null);
    $(".fullscreen-not-supported").toggle($(document).fullScreen() == null);

    $(document).bind("fullscreenchange", function(e) {
       console.log("Full screen changed.");
       $("#status").text($(document).fullScreen() ? 
         "Full screen enabled" : "Full screen disabled");
   });

    $(document).bind("fullscreenerror", function(e) {
       console.log("Full screen error.");
       $("#status").text("Browser won't enter full screen mode for some reason.");
   });

});
</script>
<script type="text/javascript">


function disableF5(e) 
{ if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82 || (e.which || e.keyCode) == 18)   e.preventDefault(); 
};

$(document).ready(function(){

	$(document).on("click","#fscreen",function(){
     	$("#myDiv").fullScreen(true);
	})
     $(document).on("keydown", disableF5);

     $(document).on("click","#btnopen",function(){
     	window.open('norefresh.php', '','_blank', 'toolbar=no,menubar=no,directories=no,status=no, scrollbars=no, resizable=no, fullscreen="yes",width='+screen.availWidth+',height='+screen.availHeight+''); return false; 
     })     

});
</script>
<script>

// NO LEAVING PAGE
window.onblur = function() {
  //alert('LOST focus');
  $("#p").html("CHEATER!");
    return false;
}

</script>
<body oncontextmenu="return false" onselectstart="return false" ondragstart="return false" >
<!--NO RIGHT CLICK -->
<div id="myDiv" style="background-color: white;color: black;">

<button id="btnopen">OPEN</button>
<button id="fscreen">FULL SCREEN</button>

<h3>Once you leave this page. You are considered as cheater. Your examination will automatically submitted.</h3>
<p>Fullscreen this window to avoid leaving the page.</p>

<p id="p"></p>

<input type="text" name="" ><br>
<input type="radio" name="">TRY CHOICE
</body>
