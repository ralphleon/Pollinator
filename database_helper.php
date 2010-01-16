<?

// Constants
define("DATABASE", "questionator");
define("QUESTIONS_TABLE" , "questions" );

// Differnt values for the question types
define('Q_YES_NO',0);
define('Q_MULTI',1);
define('Q_TEXT',2);
define('Q_MULTI_EXC',3);

function connect(){
	
	$link = mysql_connect('localhost', 'root', 'root');
	
	if(!$link) err("failure connecting to database...");
		
 	if(!@mysql_select_db(DATABASE,$link)){
		err("failure selecting the database <strong>" . DATABASE . "</strong>...");
	}

	return $link;
}

function err($string){
	
	print "Error: " . $string . "<br/>";
	print "MySQL says: \"" . mysql_error() . "\"";
	exit();
}

/**
	Prints all questions stored in the Mysql database
*/
function printQuestions(){
	
	$link = connect();
	
	$q = "SELECT * FROM ". QUESTIONS_TABLE;
	$result = mysql_query($q);
	if (!$result) err("error with query...\n Query=$q");
	
	while ( $row = mysql_fetch_array($result) ) {
	  	printQuestion($row);
	}
}

/**
	Takes an array that has "type","content", and "opts" defined and prints
	an html form element based on these values. This array is normally a row from
	the QUESTIONS_TABLE mysql table.
**/
function printQuestion($row){
	
	// All the questions have the same sort of title
	print "<div> <label>" . $row["content"] . "</label>";
	
	$id = $row["id"];
	$name = "question". $id;
	
	// But they differ in how the user responds to them
	switch($row["type"])
	{
		case Q_YES_NO:
			print '<br/><input type="radio" name="' . $name . '"><label>Yes</label>';
			print '<br/><input type="radio" name="' . $name . '"><label>No</label>';
		break;
		
		case Q_MULTI:
		
			$opts = explode( "," , $row['opts']);
			
			foreach($opts as $opt){
				print '<br/><input type="checkbox" name="' . $name .'"/>';
				print "<label>$opt</label>";				
			}
			
		break;
		
		case Q_MULTI_EXC:
			
			$opts = explode( "," , $row['opts']);

			foreach($opts as $opt){
				print '<br/><input type="radio" name="' . $name .'"/>';
				print "<label>$opt</label>";				
			}

		break;
		
		case Q_TEXT:		
			print '<br><input type="text" name="' . $name . '"/>';
		break;
	}
	
	print "</div>\n";
}

?>
