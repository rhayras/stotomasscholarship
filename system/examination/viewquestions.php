<?php
include('../../db/db.php');
include('header.php');


$id = $_GET['id'];
$level = "";
$getLevelInfo = "SELECT * FROM tbl_exam WHERE id = ".$id;
$processLevel = $db->query($getLevelInfo);
$resultLevel = $processLevel->fetch_assoc();

if($resultLevel['examtype'] == 0)
{
	$level = "Junior High School";
}
elseif($resultLevel['examtype'] == 1)
{
	$level = "Senior High School";
}
else
{
	$level = "College";
}

?>
<style>
	#myNav
	{
		/*background-color: #2e7d32;*/
		height:100px;
		padding: 20px;
		background-color: #00C851;
		color: white;
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
</style>
	<div class="row" style="padding: 10px;">
		<div class="col-md-12 col-lg-12" id="mainContainer">
			<br>
			<h4 style="color:gray;margin-bottom:-55px;">Questions For <?php echo $level?> </h4>
			<div class="pull-right">
				<button class="btn btn-success btn-xs" style="margin-bottom:5px;" data-toggle="modal" data-target="#questionModal">Add Question</button>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTableId">
					<thead>
						<th>#</th>
						<th>Category</th>
						<th>Type</th>
						<th>Question</th>
						<th>A</th>
						<th>B</th>
						<th>C</th>
						<th>D</th>
						<th>Answer</th>
						<th>ACTION</th>
					</thead>
					<tbody style="font-size: 13px;">
						<?php
						$x = 0;
						$category = '';
						$type = '';
						
						$getQuestions = "SELECT * FROM tbl_question WHERE examtypeid = ".$id;
						$process = $db->query($getQuestions);
						if($process->num_rows > 0)
						{
							while($result = $process->fetch_assoc())
							{
								$a = '---';
								$b = '---';
								$c = '---';
								$d = '---';
								if($result['questionCategory'] == 0) $category = 'Mathematics';
								if($result['questionCategory'] == 1) $category = 'English';
								if($result['questionType'] == 0){$type = 'Multiple Choice'; $a = $result['a'];$b = $result['b'];$c = $result['c'];$d = $result['d']; }
								if($result['questionType'] == 1)$type = 'Q & A';
								echo 
								"<tr>
									<td>".++$x."</td>
									<td>".$category."</td>
									<td>".$type."</td>
									<td>".$result['question']."</td>
									<td>".$a."</td>
									<td>".$b."</td>
									<td>".$c."</td>
									<td>".$d."</td>
									<td>".$result['answer']."</td>
									<td style='text-align:center'><button href='' class='btn btn-primary btn-sm edtbtn' data-id='".$result['id']."'>Edit</button> <button data-id='".$result['id']."' data-id2='".$id."' data-id3= '".$result['questionCategory']."' class='btn btn-danger btn-sm delbtn'>Delete</button>
								</tr>";
							}
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

<?php
include('footer.php');
?>
<script>
  $(document).on('change','#questionType',function(){
         var questionType = $(this).val();
          if(questionType == 0)
          {
              $('#QandADiv').hide();
              $('#multipleDiv').show();
              $('questionBlank').prop('required',false);
              $('answerBlank').prop('required',false);

               $('question').prop('required',true);
              $('a').prop('required',true);
              $('b').prop('required',true);
              $('c').prop('required',true);
              $('d').prop('required',true);
              $('ans').prop('required',true);
          }
          else
          {
              $('#QandADiv').show();
              $('#multipleDiv').hide();

              $('question').prop('required',false);
              $('a').prop('required',false);
              $('b').prop('required',false);
              $('c').prop('required',false);
              $('d').prop('required',false);
              $('ans').prop('required',false);

              $('questionBlank').prop('required',true);
              $('answerBlank').prop('required',true);
          }
      })
</script>