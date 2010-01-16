<?

// Constants
define("DATABASE", "questionator");
define("QUESTIONS_TABLE" , "questions" );
define("RESULTS_TABLE" , "results");

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
	print '<div> <label class="header">' . $row["content"] . "</label>";
	
	$id = $row["id"];
	$name = "question". $id;
	
	// But they differ in how the user responds to them
	switch($row["type"])
	{
		case Q_YES_NO:
			print '<input value="yes" type="radio" name="' . $name . '"><label>Yes</label><br/>';
			print '<input value="no"  type="radio" name="' . $name . '"><label>No</label><br/>';
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
				print '<input value="' . $opt .'" type="radio" name="' . $name .'"/>';
				print "<label>$opt</label><br/>";				
			}

		break;
		
		case Q_TEXT:		
			print '<input type="text" name="' . $name . '"/>';
		break;
	}
	
	print "</div>\n";
}

/** Process Questions
*/
function processResults()
{
	// We can grab the name and email first, because they're not dynamic questions
	$name = $_POST['name'];
	$email = $_POST['email'];
	
	print "<p>Thanks for your interest in Widget Corporation, $name. We'll be in touch shortly!</p>";
	
	$link = connect();
	
	// Loop through the dynamic fields
	$q = "SELECT * FROM ". QUESTIONS_TABLE;
	$result = mysql_query($q);
	if (!$result) err("error with query...\n Query=$q");
	
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
				$r = $_POST[$name];
			break;
		}
		
		print "<p><strong>$content</strong><br/>$r</p>";
		
		$qResults[$name] = $r;
		
	} // end while
		
	// Insert a new record with the name and email filled in
	$cols = "name,email";
	$values = "'$name','$email'";
			
	foreach($qResults as $key => $val) {
	    $cols = $cols . "," . $key;
		$values = $values . ",'" . $val . "'";
	}

	$q = "INSERT into " . RESULTS_TABLE . " ($cols) VALUES($values)";
	$result = mysql_query($q);
	if (!$result) err("error with query...\n Query=$q");
	
}

?>
