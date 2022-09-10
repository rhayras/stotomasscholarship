<?php
include('../../db/db.php');
include('header.php');
$schyear = "2019";
$sem = "1st Semester";
$getCurrent = "SELECT * FROM tbl_currentyear";
$processCurrent = $db->query($getCurrent);
if($processCurrent->num_rows > 0)
{
	$resultCurrent = $processCurrent->fetch_assoc();
	$schyear = $resultCurrent['schyear'];
	$sem = $resultCurrent['semester'];
}

$schoolyear = (isset($_POST['schyear'])) ? $_POST['schyear'] : $schyear;
$semester = (isset($_POST['semester'])) ? $_POST['semester'] : $sem;
?>
<style>
	
	#myNav
	{
		background-color: white;
		height:100px;
		padding: 20px;
	}
	body
	{
		background-color:#f5f5f5;
	}
	.navbar-default {
	   padding-top: 10px;
	  padding-bottom: 10px;
	}
   body
    {
      background-image: linear-gradient(to top, #a5d6a7 , #a5d6a7 );
    }
    #mainContainer
    {
    	background-color:white;
    	padding: 10px;
    	padding-left: 20px;
    	padding-right: 10px;
    	width: 100%;
    	height: auto;
    }
    #chartdiv {
			width   : 100%;
			height    : 300px;
			font-size : 11px;
			border:1px solid gainsboro;
		}
	 #chartdiv1 {
		width   : 100%;
		height    : 300px;
		font-size : 11px;
		border:1px solid gainsboro;
	}
	#chartdiv3 {
		width   : 100%;
		height    : 300px;
		font-size : 11px;
		border:1px solid gainsboro;
	}
	#chartdiv4 {
		width   : 100%;
		height    : 300px;
		font-size : 11px;
		border:1px solid gainsboro;
	}
	#chartdiv5 {
            width   : 100%;
            height    : 400px;
            font-size : 11px;
            border: 1px solid gray;
        }
	</style>

<script>
	    var chartData= 
	    [
	    <?php 
	    $sql = "SELECT examresult,COUNT(studentId) as scholarCount FROM tbl_examevaluation WHERE schoolyear = '".$schoolyear."' AND semester = '".$semester."' GROUP BY examresult ORDER BY examresult ASC ";
	    $processQuery = $db->query($sql);
	    while($resultQuery = $processQuery->fetch_assoc())
	    {
	     echo '{"examresult":"' . $resultQuery['examresult']. '","scholarCount":" '. $resultQuery['scholarCount'] . '"},';
	   }
	   ?>
	   ] ;
	   var chart = AmCharts.makeChart( "chartdiv3", {
	     "hideCredits":true,
	     "type": "serial",
	     "theme": "light",
	    
	     "dataProvider": chartData,
	     "chartCursor": {
	      "categoryBalloonEnabled": false,
	      "cursorAlpha": 0,
	      "zoomable": false
	    },
	    "allLabels": [{
	      "text": "Examination Result",
	      "align": "center",
	      "size": 18,
	      "y": 10
	    }],
	    "marginTop": 50,
	    "graphs": [ {
	      "balloonText": "[[examresult]]: <b>[[value]]</b>",
	      "fillAlphas": 0.8,
	      "lineAlpha": 0.2,
	      "showAllValueLabels":true, 
	      "labelText": " [[scholarCount]]",  
	      "labelPosition": "top",
	      "fontSize": 12,
	      "color": "black",
	      "type": "column",
	      "valueField": "scholarCount"
	    } ],

	    "categoryField": "examresult",
	    "categoryAxis": {
	      "gridPosition": "start",
	      "gridAlpha": 0,
	      "tickPosition": "start",
	      "tickLength": 20
	    },
	  } );
</script>

<script>
    var chartData = 
    [
		    <?php 
		    $studentArray = array();
		    $shsGraduatings = 0;
		    $collegeGraduatings = 0;
		    $sql = "SELECT * FROM tbl_scholarhistory WHERE schoolyear = '".$schoolyear."' AND sem = '".$semester."'";
		    $process = $db->query($sql);
		    if($process->num_rows > 0)
		    {
		    	while($result = $process->fetch_assoc())
		    	{
		    			
		    		
		    		if($result['yearOrgrade'] == "Grade 12") $shsGraduatings++;
		    		if($result['yearOrgrade'] == "4th Year") $collegeGraduatings++;
		    	}
			    for($x = 1;$x<= 2; $x++)
			    {
			    	$studentType = '';
			    	$scholarCount = 0;
			    	if($x == 1){$studentType =  "Senior High School"; $scholarCount =  $shsGraduatings;}
			    	elseif($x == 2) {$studentType =  "College"; $scholarCount =  $collegeGraduatings;}

			    	echo '{"studentType":"' . $studentType. '","scholarCount":" '. $scholarCount . '"},';
			    }
		    }
		   ?>
    ] ;
	var chart = AmCharts.makeChart( "chartdiv4", {
	  "hideCredits":true,
	  "type": "pie",
	  "theme": "none",
	  "autoMargins": false,
		      "legend":{
		        "position":"bottom",
		        "marginRight":20,
		        "autoMargins":false
		      },
	  "titles": [ {
	    "text": "Graduating Students",
	    "size": 16
	  } ],
	  "dataProvider": chartData ,
	  "valueField": "scholarCount",
	  "titleField": "studentType",
	  "startEffect": "elastic",
	  "startDuration": 2,
	  "labelRadius": 15,
	  "innerRadius": "0",
	  "depth3D": 10,
	  "balloonText": "[[studentType]]<br><span style='font-size:14px'><b>[[scholarCount]]</b></span>",
	  "angle": 15,
	  "export": {
	    "enabled": true
	  }
	} );
</script>

<script>
	    var chartData = 
	    [
		    <?php 
		    $sql = "SELECT studenttype,COUNT(studentId) as scholarCount FROM tbl_scholarhistory WHERE schoolyear = '".$schoolyear."' AND sem = '".$semester."' GROUP BY studenttype ORDER BY studenttype ASC ";
		    $processQuery = $db->query($sql);
		    while($resultQuery = $processQuery->fetch_assoc())
		    {
		     echo '{"studenttype":"' . $resultQuery['studenttype']. '","scholarCount":" '. $resultQuery['scholarCount'] . '"},';
		   }
		   ?>
	   ] ;
	   var chart = AmCharts.makeChart( "chartdiv", {
		     "hideCredits":true,
		     "type": "serial",
		     "theme": "light",
		     "colors": [
		     "green"
		     ],
		     "dataProvider": chartData,
		     "chartCursor": {
		      "categoryBalloonEnabled": false,
		      "cursorAlpha": 0,
		      "zoomable": false
		    },
		    "allLabels": [{
		      "text": "EPS Scholars",
		      "align": "center",
		      "size": 18,
		      "y": 10
		    }],
		    "marginTop": 50,
		    "graphs": [ {
		      "balloonText": "[[category]]: <b>[[value]]</b>",
		      "fillAlphas": 0.8,
		      "lineAlpha": 0.2,
		      "showAllValueLabels":true, 
		      "labelText": " [[scholarCount]]",  
		      "labelPosition": "top",
		      "fontSize": 12,
		      "color": "black",
		      "type": "column",
		      "valueField": "scholarCount"
		    } ],

		    "categoryField": "studenttype",
		    "categoryAxis": {
		      "gridPosition": "start",
		      "gridAlpha": 0,
		      "tickPosition": "start",
		      "tickLength": 20
		    },
	  } );
</script>

<script>
    var chartData = 
    [
	    <?php 
	    $studentArray = array();
	    $sql = "SELECT * FROM tbl_scholarhistory WHERE schoolyear = '".$schoolyear."' AND sem = '".$semester."'  ";
	    $processQuery = $db->query($sql);
	    while($resultQuery = $processQuery->fetch_assoc())
	    {
	    	$studentArray[] = $resultQuery['studentId'];
	    }
		$sql1 = "SELECT  address,COUNT(id) as totalStudents FROM tbl_student WHERE id IN (".implode(",",$studentArray).") GROUP BY address";
		$process1 = $db->query($sql1);
		while($result1 = $process1->fetch_assoc())
		{
	 		echo '{"address":"' . $result1['address']. '","totalStudents":" '. $result1['totalStudents'] . '"},';
		}
	   ?>
   ] ;
    var chart = AmCharts.makeChart("chartdiv1", {
      "hideCredits":true,
      "labelsEnabled": false,
      "radius": 80,
      "autoMargins": false,
      "legend":{
        "position":"bottom",
        "marginRight":20,
        "autoMargins":false
      },
       "allLabels": [{
	      "text": "Scholars Per Barangay",
	      "align": "center",
	      "size": 18,
	      "y": 10
	    }],
      "type": "pie",
      "startDuration": 0,
      "theme": "light",
      "addClassNames": true,
      "innerRadius": "55%",
      "defs": {
        "filter": [{
          "id": "shadow",
          "width": "200%",
          "height": "200%",
          "feOffset": {
            "result": "offOut",
            "in": "SourceAlpha",
            "dx": 0,
            "dy": 0
          },
          "feGaussianBlur": {
            "result": "blurOut",
            "in": "offOut",
            "stdDeviation": 5
          },
          "feBlend": {
            "in": "SourceGraphic",
            "in2": "blurOut",
            "mode": "normal"
          }
        }]
      },
      "dataProvider": chartData,
      "balloonText": "[[address]]<br><span style='font-size:14px'><b>[[totalStudents]]</b></span>",
      "valueField": "totalStudents",
      "titleField": "address",
      "export": {
        "enabled": true
      }
    });

    chart.addListener("init", handleInit);

    chart.addListener("rollOverSlice", function(e) {
      handleRollOver(e);
    });

    function handleInit(){
      chart.legend.addListener("rollOverItem", handleRollOver);
    }

    function handleRollOver(e){
      var wedge = e.dataItem.wedge.node;
      wedge.parentNode.appendChild(wedge);
    }
</script>
<script>
    	var linedata = 
        [
        <?php 
        $sql = "SELECT COUNT(*) as totalCount,year FROM tbl_scholarhistory GROUP BY year ORDER BY year ASC";
        $process = $db->query($sql);
        if($process->num_rows > 0)
        {
            while($result = $process->fetch_assoc())
            {
                $totalCount = $result['totalCount'];
                $year = $result['year'];
                echo '{"year":"'.$year.'","totalCount":"'.$totalCount.'"},';
            }
        }
        ?>
        ] ;
        var lineChart = AmCharts.makeChart("chartdiv5", {
            "hideCredits":true,
            "type": "serial",
            "theme": "light",
            "marginTop":0,
            "marginRight": 80,
            "dataProvider": linedata,
            "allLabels": [{
	      "text": "Scholars Per Year",
	      "align": "center",
	      "size": 18,
	      "y": 10
	    }],
            "graphs": [{
                "id":"g1",
                "balloonText": "[[category]]<br><b><span style='font-size:14px;'>Scholars Count : [[value]]</span></b>",
                "bullet": "round",
                "bulletSize": 10,
                "lineColor": "green",
                "lineThickness": 1,
                "negativeLineColor": "#637bb6",
                "type": "smoothedLine",
                "valueField": "totalCount"
            }],
            
            "categoryField": "year",
            "categoryAxis": {
                "minorGridAlpha": 0.1,
                "minorGridEnabled": true
            }
        });

        
</script>
<br>
<div class="row" style="padding: 10px;">
	<div class="col-md-12 col-lg-12" id="mainContainer">
		<center>
			<h3>Analytic Features</h3><br>
			<form method="POST" id="epsScholarForm"></form>
			<label>School Year</label>
			<select name="schyear" id="schyear" form="epsScholarForm">
				<?php
				$selectedYear = "";
				$sql = "SELECT DISTINCT schoolyear FROM tbl_scholarhistory";
				$process = $db->query($sql);
				if($process->num_rows > 0)
				{
					while($result = $process->fetch_assoc())
					{
						?>
						<option <?php if($result['schoolyear'] == $schoolyear){echo "selected";}?>><?php echo $result['schoolyear'] ?></option>
						<?php
					}
				}
				?>
			</select>
			<label>Semester</label>
			<select name="semester" id="semester" form="epsScholarForm">
				<?php
				$selectedSem = "";
				$sql = "SELECT DISTINCT sem FROM tbl_scholarhistory";
				$process = $db->query($sql);
				if($process->num_rows > 0)
				{
					while($result = $process->fetch_assoc())
					{
						?>
						<option <?php if($result['sem'] == $semester){echo "selected";}?>><?php echo $result['sem'] ?></option>
						<?php
					}
				}
				?>
			</select>
			<input type="submit" name="epsScholarSubmit" value="Filter" form="epsScholarForm" class="btn btn-success btn-sm">
		</center>
		<div class="row">
			<div class="col-md-2 col-lg-2"></div>
			<div class="col-md-8 col-lg-8"> 
	   			<div id="chartdiv"></div>
			</div>
			<div class="col-md-2 col-lg-2"></div>
		</div><br>
		<div class="row">
			<div class="col-md-2 col-lg-2"></div>
			<div class="col-md-8 col-lg-8"> 
	   			<div id="chartdiv1"></div>
			</div>
			<div class="col-md-2 col-lg-2"></div>
		</div><br>
		<div class="row">
			<div class="col-md-2 col-lg-2"></div>
			<div class="col-md-8 col-lg-8"> 
	   			<div id="chartdiv3"></div>
			</div>
			<div class="col-md-2 col-lg-2"></div>
		</div><br>
		<div class="row">
			<div class="col-md-2 col-lg-2"></div>
			<div class="col-md-8 col-lg-8"> 
	   			<div id="chartdiv4"></div>
			</div>
			<div class="col-md-2 col-lg-2"></div>
		</div><br>
		<div class="row">
			<div class="col-md-2 col-lg-2"></div>
			<div class="col-md-8 col-lg-8"> 
	   			<div id="chartdiv5"></div>
			</div>
			<div class="col-md-2 col-lg-2"></div>
		</div><br>
</div>
<?php
include('footer.php');
?>
