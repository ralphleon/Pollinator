<?
	/** Simple helper script to setupt the databases, could allow usernames, etc later */
	
	include("database_helper.php");
	connect();
	
	/** Very simple setup script */
	$q = "DROP TABLE IF EXISTS " . RESULTS_TABLE;
	$r = mysql_query($q) or mysql_err($q);
	
	$q = "DROP TABLE IF EXISTS " . QUESTIONS_TABLE;
	$r = mysql_query($q) or mysql_err($q);
	
	$q = "CREATE TABLE " . QUESTIONS_TABLE 
		 . "(id INT NOT NULL AUTO_INCREMENT," 
		 . "PRIMARY KEY(id),"
		 . "type INT, content TEXT, opts TEXT)";

	$r = mysql_query($q) or mysql_err($q);
	
	disconnect();
?>

<h1>Databases created successfully!</h1>
