<?
/** This file defines functions that allow for database access. Please use "config.php"
 *  to setup pollster for your specific database
 */

include("config.php");

// Differnt values for the question types
define('Q_TEXT',0);
define('Q_YES_NO',1);
define('Q_MULTI',2);
define('Q_MULTI_EXC',3);

/** Connects to a database, we don't need a link for our purposes */
function connect(){
	
	mysql_connect(DB_SERVER, DB_USER, DB_PASS) or err("failure connecting to database...");
		
 	if(!@mysql_select_db(DB)){
		err("failure selecting the database <strong>" . DB . "</strong>...");
	}
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
