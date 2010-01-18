<?
// Constants
define("DATABASE", "questionator");
define("QUESTIONS_TABLE" , "questions" );
define("RESULTS_TABLE" , "results");

// Differnt values for the question types
define('Q_TEXT',0);
define('Q_YES_NO',1);
define('Q_MULTI',2);
define('Q_MULTI_EXC',3);

function connect(){
	
	$link = mysql_connect('localhost', 'root', 'root');
	
	if(!$link) err("failure connecting to database...");
		
 	if(!@mysql_select_db(DATABASE,$link)){
		err("failure selecting the database <strong>" . DATABASE . "</strong>...");
	}

	return $link;
}

function disconnect(){
	mysql_close();
}

function err($string){
	
	print "Error: " . $string . "<br/>";
	exit();
}

function mysql_err($q){
	
	print "Error in Query: " . $q. "<br/>";
	print "MySQL says: \"" . mysql_error() . "\"";
	exit();
}


?>
