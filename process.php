<? 
	$title = "results";
	include("header.php") ?>
		
<p>Thanks for filling out the poll! We'll get back to you shortly. Below are your responses:</p>
<?
		include("pollinator/question_viewer.php");				
		// Process the results
		processResults();
?>		

<? include("footer.php"); ?>