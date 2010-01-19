<?
include("database_helper.php");
	
/**
 *	Prints all questions stored in the Mysql database
 */
function printQuestions(){
	
	$link = connect();
	
	$q = "SELECT * FROM ". QUESTIONS_TABLE;
	$result = mysql_query($q) or err("No database configured yet, please use the admin interface!");
	
	while ( $row = mysql_fetch_array($result) ) {
	  	printQuestion($row);
	}
	
	disconnect();
}

/**
 *	Takes an array that has "type","content", and "opts" defined and prints
 *	an html form element based on these values. This array is normally a row from
 *	the QUESTIONS_TABLE mysql table.
 */
function printQuestion($row){
	
	// All the questions have the same sort of title
	print '<div> <label class="header">' . $row["content"] . "</label>";
	
	$id = $row["id"];
	$name = "question". $id;
	
	// But they differ in how the user responds to them
	switch($row["type"])
	{
		case Q_YES_NO:
			printf('<input class="validate[required] radio" value="yes" type="radio" id="%s" name="%s"><label>Yes</label><br/>',$name,$name);
			printf('<input class="validate[required] radio" value="no"  type="radio" id="%s" name="%s"><label>No</label><br/>',$name,$name);
		break;
		
		case Q_MULTI:
		
			$opts = explode( "," , $row['opts']);
			
			foreach($opts as $opt){
				print '<input type="checkbox" name="' . $name . $opt .'"/>';
				print "<label>$opt</label><br/>";			
			}
			
		break;
		
		case Q_MULTI_EXC:
			
			$opts = explode( "," , $row['opts']);

			foreach($opts as $opt){
				printf('<input class="validate[required] radio" value="%s" type="radio" id="%s" name="%s"/>',$opt,$name,$name);
				print "<label>$opt</label><br/>";				
			}
		break;
		
		case Q_TEXT:		
			printf('<input class="validate[required,length[1,100]] text-input" type="text" id="%s" name="%s"/>',$name,$name);
		break;
	}
	
	print "</div>\n";
}

/** 
 * Process Questions
 */
function processResults(){
	
	connect();
	
	// Loop through the dynamic fields
	$q = "SELECT * FROM ". QUESTIONS_TABLE;
	$result = mysql_query($q) or mysql_err($q);
	
	// store the column names, and their answers
	$qResults = Array();
	
	while( $row = mysql_fetch_array($result) ) {
	  	$id = $row['id'];
		$name = "question" . $id;
		$content = $row["content"];
		$r = "";
		
		switch($row["type"]){
			
			// multiple check boxes are a pain in the ass.
			case Q_MULTI:
				
				$opts = explode(",", $row['opts']);
				
				foreach($opts as $opt){
									
					//If the value is set, then it was checked
					if(isset($_POST[ $name . $opt])){
						$r = $r  . $opt . ",";
					}
				}
			break;
		
			// everything else can use a standard case
			default:			
				// try to gather the result for the question
				$r = mysql_real_escape_string($_POST[$name]);
			break;
		}
		
		print "<p><strong>$content</strong><br/>$r</p>";
		
		$qResults[$name] = $r;
		
	} // end while
			
	$cols = ""; $values = "";
	
	foreach($qResults as $key => $val) {
	    $cols = $cols . $key . ",";
		$values = $values . "'" . $val . "'" . ",";
	}
	
	$cols = rtrim($cols,",");
	$values = rtrim($values,",");

	// Gaurd against SQL injection atttacks
	$q = sprintf("INSERT into %s (%s) VALUES(%s)", RESULTS_TABLE,$cols,$values);
			
	$result = mysql_query($q) or mysql_err($q);

	disconnect();
}
?>