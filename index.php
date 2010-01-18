<? include("header.php")  ?>

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine-en.js" type="text/javascript"></script>
<script src="js/jquery.validationEngine.js" type="text/javascript"></script>

<div id="container">
		
	<h1>Widget Corporation(tm) Interview Questions</h1>
	
	<p>Thank you for your interest in <strong>Widget Corporation</strong> please answer 
	the following questions as honestly as possibly</p>
	
	<link rel="stylesheet" href="css/validationEngine.jquery.css" type="text/css" media="screen" title="no title" charset="utf-8" />
 		
	<script>
	$(document).ready(function() {
		$("#questionsForm").validationEngine();
	});
	</script>

	<form id="questionsForm" method="post" action="process.php">
		
	<?
		include("pollinator/question_viewer.php");
		printQuestions();
	?>	
	
	<input type="submit" class="submit" value="Submit" />
	
	</form>
</div>
	
</html></body>