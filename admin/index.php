<? 
	include("header.php");
	include("../pollinator/admin_helper.php") 
?>

<div id="container">
	
	<h1>Administration</h1>
	
	<p>Respondents to the poll:</p>
	<div id="tableHolder">
	<? printResultsTable() ?>
	</div>
</div>
</html></body>