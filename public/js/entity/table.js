function table() {	
}
	
table.prototype.onjquery = function() {	
};

table.prototype.selectTable = function(objectClass,selectClass) {
    $('.'+objectClass).click(function() {
        if($(this).hasClass(selectClass)){
            $('.'+objectClass).removeClass(selectClass);        
            $( "input[name='id']" ).val('');                
            
			//clear service menu
			$('.services-table .table').html('');
            
            
        }else{
            $('.'+objectClass).removeClass(selectClass);        
            $(this).toggleClass(selectClass);
            $( "input[name='id']" ).val($(this)[0].children[0].value);    
            
            //call to service of the table
			var data = new Array();
			//data['store_id'] = $('#slect-service-form').children()[1].value;
			data['store_id'] = $( "input[name='store_id']" ).val();
			data['table_id'] = $(this)[0].children[0].value;
			if($(this)[0].children.length > 2){data['service_id'] = $(this)[0].children[2].value;}			
			ajaxobject.peticionajax($('#slect-service-form').attr('action'),data,"table.selectServiceResponse");
        }
		
    });	
};

table.prototype.selectServiceResponse = function(result) {
	$('.services-table .table').html(result.data.table[0].name);
}

var table = new table();
