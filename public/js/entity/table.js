function table() {	
}
	
table.prototype.onjquery = function() {	
};

table.prototype.selectTable = function(objectClass,selectClass) {
    $('.'+objectClass).click(function() {
        if($(this).hasClass(selectClass)){
            $('.'+objectClass).removeClass(selectClass);        
            $( "input[name*='id']" ).val('');    
        }else{
            $('.'+objectClass).removeClass(selectClass);        
            $(this).toggleClass(selectClass);
            $( "input[name*='id']" ).val($(this)[0].children[0].value);    
        }
		//call to service of the table
		
		//ajaxobject.peticionajax($('#slect-service-form').attr('action'),data,"selectServiceResponse");
    });

	
	
	
};
var table = new table();