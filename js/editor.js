$(document).ready(function(){
	
var Q_MULTI = 2;
var Q_MULTI_EXC = 3;

/** Boxy dialog
 */
$(function() {
  $('.boxy').boxy();
});

/** Callback for selection changes in "type"
 *  Will hide or show the "options" box if needed
 */
$('select[name=type]').live("change",function(e){
		
	// Sketchy to use 3, was having trouble with name though... this 
	// hides and shows the extended detail block;
	var opts = this.parentNode.parentNode.childNodes[3]; 
	
	if(this.value == Q_MULTI || this.value == Q_MULTI_EXC){		
		$(opts).slideDown("slow");
	}else{	
		$(opts).slideUp("slow");
	}
});

/** Callback for the delete button 
 * Removes the current block, live for newly added questions
 */
$('a').live("click",function(e){
	var parent = this.parentNode.parentNode; 	
	$(parent).fadeOut(800,function(){ 
		parent.parentNode.removeChild(parent);
	});
});

/**
 * Button callback for the "add" button. Adds a new question editor, based
 * on the first question editor
*/
$('#add').click(function(event){
	// Clone the sample data
	$('div.question:first').clone().appendTo("#questionsBlock");	
	$('div.question:last').fadeIn(800);
});

/**
 * Callback for the submit button.
 * Packages up the question data in JSON and passes it to the server
 */
$('#submit').click(function(event){
	
	var questions = [ ];
	
	// Package up the current questions, loop through all elements except 
	// for my first element which i use for cloaning 
	$('#questionsBlock').find('div.question:not(div:first)').each( function( i ){
	
		var q = { content : "", opts : "", type : ""};
		
		$(this).find('textarea[name=content]:first').each( function(){
			q.content = this.value;
		});		
		$(this).find('textarea[name=opts]:first').each( function(){
			q.opts = this.value;
		});
		
		$(this).find('select[name=type]').each( function(){
			q.type = this.value;
		});
		
		questions.push(q);
	});
	
	// Confirm then send off ajax call
	Boxy.confirm("This will remove all previously stored results! Are you sure?", function() { 	
		
		$.post("../pollinator/editor_update.php", { questions: questions },
			function(data){
				// Parse your response code here. We're going to be lazy, so it's ALWAYS A O.K.
				// because, how could it go wrong? This code is _rock_ solid. </sarcasm> 	
				//alert(data);			
			});		
	});
	
});


});