
$(document).ready(function(){
	
var Q_MULTI = 2;
var Q_MULTI_EXC = 3;

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
	$(parent).fadeOut(1000,function(){ 
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
	$('div.question:last').fadeIn(1000);
});

/**
 * Callback for the submit button.
 * Packages up the question data in JSON and passes it to the server
 */
$('#submit').click(function(event){
	
	// Package up the current questions, loop through all elements except 
	// for my first element which i use for cloaning 
	$('#questionsBlock').find('div.question:not(div:first)').each( function( i ){
	
		var content = "", opts = "", type = "";
		
		// For the love of peet, why doesn't a dynamically added textbox work the same 
		// as a static one? Hence the two methods of accessing the 'value'	
		$(this).find('textarea[name=content]:first').each( function(){
			if(this.lastChild) content = this.lastChild.nodeValue;	
			else if(this.value) content = this.value;
		});		
		$(this).find('textarea[name=opts]:first').each( function(){
			if(this.lastChild) opts = this.lastChild.nodeValue;	
			else if(this.value) opts = this.value;
		});
		
		$(this).find('select[name=type]').each( function(){
			type = this.value;
		});
		
		alert("content " + content + " opts " + opts + " type " + type);
	});
	
});


});
