<? include("header.php") ?>

<div id="container">
		
	<h1>Widget Corporation(tm) Interview Questions</h1>
	
	<p>Thank you for your interest in <strong>Widget Corporation</strong> please answer 
	the following questions as honestly as possibly</p>
		
	
	<form method="post" action="process.php">

		<!-- Some questions are hard-wired -->
		<label class="header">Name</label>
		<input class="text" name="name" type="text"/>
		
		<label class="header">Email</label>
		<input class="text" name="email" type="text"/>
		
<?
		include("database_helper.php");
		printQuestions();
?>	
	
	<input type="submit" class="submit" value="Submit" />
	
	</form>
</div>
	
</html></body>