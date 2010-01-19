<? 
	$title = "Secret Admin Section";
	include("../header.php");
	include("../pollinator/admin_helper.php") 
?>

<p> Welcome to the admin section where you can get into the bolts of your poll! What are you interested in?</p>

<ul>
	<li><a href="editor.php">Editing</a> the poll's questions...</li>
	<li><a href="print.php"> Viewing</a> all of the respondent answers...</li>
</ul>

<h3>Quick Summary</h3>

<p> So far you've had <strong> <? numberOfRespondents() ?> </strong> people respond!</p>
	
<? include("../footer.php"); ?>