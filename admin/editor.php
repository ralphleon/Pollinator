<? $title = "Question Editor"; include("../header.php") ?>

<script type="text/javascript" src="/questionator/js/jquery.js"></script>	 	
<script type="text/javascript" src="/questionator/js/editor.js"></script> 
<script type="text/javascript" src="/questionator/js/jquery.boxy.js"></script> 
	
	<form class="boxy" id="editForm" action=""> 
		
		<div id="questionsBlock">
			
			<!-- Sample Question -->
			<div class="question" style="display:none">		
				<div class="main">
					<label>Question <span class="small">The main question</span></label>

					<textarea name="content"></textarea>

					<label>Type<span class="small">Type of the question</span></label>
					<select name="type">

						<option value="0" selected="true">Free text</option>";
						<option value="1">Yes / No </option>";
						<option value="2">List (select any)</option>";
						<option value="3">List (select one)</option>";
					</select>
				</div>

				<div class="opts" style="display:none">
					<label>List<span class="small">Newline separated</span></label>
					<textarea name="opts"></textarea>
				</div>

				<div class="delete">
					<a href="#">Delete</a>
				</div>	
			</div>
			
		<? 	
			include("../pollinator/editor_helper.php");
			printQuestionsEditor();
		?>
		</div>
		
		<div id="controls">
			<input id="add" type="button" value="Add">
			<input id="submit" type="button" value="submit"/>
		</div>
	</form>
	
<? include("../footer.php");?>