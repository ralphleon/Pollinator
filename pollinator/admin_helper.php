<?
	include("../pollinator/database_helper.php");

/**
 * Print the results table, which stores all of the results
 */
function printResultsTable(){
	
	print '<table class="admin"><thead>' . "\n";
		
	connect();

	// Print the header
	$q = "SELECT * FROM ". QUESTIONS_TABLE;
	$result = mysql_query($q) or mysql_err($q);

	print "<tr><th>ID</th>";
	while($row = mysql_fetch_assoc($result) ){ 
		print "<th>" . $row['content'] ."</th>";
	}	
	print '</tr></thead><tbody class="scrollContent">';
	
	// Print the actual results
	$q = "SELECT * FROM " . RESULTS_TABLE;
	$result = mysql_query($q) or mysql_err($q);
	
	// print out the header, access questions database for short questions
	while($row = mysql_fetch_row($result) ){
		
		print "<tr>";
		foreach($row as $key => $attr){ 
			print "<td>" . $attr . "</td>";
		}
		print "</tr>";
	}
	
	print '</tbody></table>' ."\n";
	
	disconnect();
}

/** Prints the number of people that have responded to the poll */
function numberOfRespondents(){
	connect();
	
	$q = "SELECT * FROM ". RESULTS_TABLE;
	$result = mysql_query($q) or mysql_err($q);
	
	print mysql_num_rows($result);
	
	disconnect();
}


?>