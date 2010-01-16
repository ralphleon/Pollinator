<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US"> 
<head profile="http://gmpg.org/xfn/11"> 
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
	<title>Solid Sushi</title> 
 
	<!-- Favicon --> 
	<link rel="icon" type="image/png" href="/images/favicon.png" /> 
 
	<!-- stylesheets --> 
	<link rel="stylesheet" href="/css/main.css" type="text/css" media="screen" /> 
</head>
<body>

	<div id="container">
		
	<h1>Widget Corporation Interview Questions</h1>
	
	<p>Thank you for your interest in <strong>Widget Corporation</strong> please answer 
	the following questions as honestly as possibly</p>
		
	
	<form>
		
<?
	include("database_helper.php");
	
	//connect to our database
	//parse through the questions
	
	
	printQuestions();

?>	
	
	
	<input type="submit" value="Submit" />
	
	</form>
	</div>
	
</body>