function invoice() {	
}
	
invoice.prototype.onjquery = function() {	
};

invoice.prototype.selectObject = function(objectClass,selectClass) {
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

invoice.prototype.addProduct = function() {	
	alert('listo el pollo');
};

var invoice = new invoice();