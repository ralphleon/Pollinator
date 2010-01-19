<? 
	$title = "Secret Admin Section";
	include("../header.php");
	include("../pollinator/admin_helper.php") 
?>

	
	<p>Respondents to the poll:</p>
	<div id="tableHolder">
	<? printResultsTable() ?>
	</div>

<? include("../footer.php"); ?>