<?
	include("database_helper.php");

	/**
	 * Prints out the questions editor, with all of the databases's 
	 * current data loaded into it.
	 */
	function printQuestionsEditor(){
		
		$link = connect();
		
		$q = "SELECT * FROM ". QUESTIONS_TABLE;
		$result = mysql_query($q) or mysql_err($q);

		while ( $row = mysql_fetch_array($result) ) {
		  	printEditor($row);
		}
	}
	
	/** 
	 * Prints an individual editor, for the $row give. The row should be a key-value pair
	 * from the questions mysql database.
	 */
	function printEditor($row){
		
		$content = $row['content'];
		$type = $row['type'];
		$opts = $row['opts'];
		
		$hideOpts = "style=\"display:none;\"";
		
		if($type == Q_MULTI || $type == Q_MULTI_EXC) $hideOpts= "";
		
		print <<< EOF
	<div class="question">		
		<div class="main">
			<label>Question <span class="small">The main question</span></label>

			<textarea name="content">$content</textarea>

			<label>Type<span class="small">Type of the question</span></label>
			<select name="type">
EOF;

		// This should obviously be a list, ugly code
		if($type != Q_TEXT) print "<option value=\"0\">Free text</option>";
		else print "<option value=\"0\" selected=\"true\">Free text</option>";
		
		if($type != Q_YES_NO) print "<option value=\"1\">Yes / No </option>";
		else print "<option value=\"1\" selected=\"true\">Yes / No </option>";
		
		if($type != Q_MULTI) print "<option value=\"2\">List (select any)</option>";
		else print "<option value=\"2\" selected=\"true\">List (select any)</option>";
		
		if($type != Q_MULTI_EXC) print "<option value=\"3\">List (select one)</option>";
		else print "<option value=\"3\" selected=\"true\">List (select one)</option>";
	
		print <<< EOF
			</select>
		</div>

		<div class="opts" $hideOpts>
			<label>List<span class="small">Newline separated</span></label>
			<textarea name="opts">$opts</textarea>
		</div>

		<div class="delete">
			<a href="#">Delete</a>
		</div>	
	</div>
EOF;
	}

?>