<? include("../header.php") ?>

<div id="container">
	
	<h1>Administration</h1>
	
	<!--<form> 	
		<div class="question">		
			<div class="main">
				<label>Question <span class="small">The main question</span></label>
			
				<textarea name="content"> </textarea>
			
				<label>Type<span class="small">Type of the question</span></label>
				<select name="type">
					<option>Free text</option>
					<option>Yes / No </option>
					<option>List (select one)</option>
					<option>List (select any)</option>
				</select>
			</div>
			
			<div class="opts">
				<label>List<span class="small">Newline separated</span></label>
				<textarea name="opts"> </textarea>
			</div>
					
			<div class="delete">
				<a href="">Delete</a>
			</div>	
		</div>
	
	</form>-->
	
	<?
	
	include("editor_helper.php");
	printQuestionsEditor();
	
	
	?>
	
</div>
</html></body>