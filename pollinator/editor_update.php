<?
	/** 
	 *	Callback code for the editor AJAX. This code takes the edited questions
	 *	and adds them to the questions table. Currently it drops the entire
	 *	results table (lazy) to avoid conflicts and refactoring. This could be added 
	 *	later by using hash values instead of question #.
	 */
	
	include("database_helper.php");
	
	// Unwrap the JSON results 
	$data = $_POST['questions'];
	print_r($data);	
	connect();
	
	// Dump all questions, add the new questions to a sql query string
	$q = "TRUNCATE TABLE " . QUESTIONS_TABLE;
	$result = mysql_query($q) or mysql_err($q);
	
	$questions_sql = ""; $i = 0;
	
	foreach($data as $question){
		$content = mysql_real_escape_string($question["content"]);
		$opts = mysql_real_escape_string($question["opts"]);
		$type = $question["type"];
		
		$q = "INSERT into " . QUESTIONS_TABLE . "(type,content,opts) VALUES('$type','$content','$opts')";
		mysql_query($q) or mysql_err($q);
		
		$questions_sql = $questions_sql . ",question" . ++$i . " TEXT";	
	}
	
	// Make a mysql CREATE TABLE query for the results table
	$q = "DROP TABLE IF EXISTS " . RESULTS_TABLE;
	mysql_query($q) or mysql_err($q);
	
	$q = "CREATE TABLE " . RESULTS_TABLE 
		 . "(id INT NOT NULL AUTO_INCREMENT," 
		 . "PRIMARY KEY(id)"
		 . $questions_sql . ")";
		
	mysql_query($q) or mysql_err($q);
	
	// We should return an error/sucess method here
?>
