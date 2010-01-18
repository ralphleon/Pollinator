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

	print "<tr><td>ID</td>";
	while($row = mysql_fetch_assoc($result) ){ 
		print "<td>" . $row['content'] ."</td>";
	}	
	print '</tr></thead><tbody>';
	
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

?>