function expense() {	
}
	
expense.prototype.onjquery = function() {	
};

expense.prototype.selectObject = function(objectClass,selectClass) {
    $('.'+objectClass).click(function() {
        if($(this).hasClass(selectClass)){
            $('.'+objectClass).removeClass(selectClass);        
            $( "input[name='id']" ).val('');
            
        }else{
            $('.'+objectClass).removeClass(selectClass);        
            $(this).toggleClass(selectClass);
            $( "input[name='id']" ).val($(this)[0].children[0].value);               
           
        }
    });	
};

var expense = new expense();