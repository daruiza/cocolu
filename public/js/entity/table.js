function table() {	
}
	
table.prototype.onjquery = function() {	
	table.selectTable('object-table','selected-table');	
};

table.prototype.selectTable = function(objectClass,selectClass) {
    $('.'+objectClass).click(function() {
    	//clear service menu
		$('.services-table .table').html('');
		$('.services-table .new-orders').html('');

        if($(this).hasClass(selectClass)){
            $('.'+objectClass).removeClass(selectClass);        
            $( "input[name='id']" ).val('');                
            
			
            
            
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


	//Orden solo si hay servicio
	if(result.data.service.length){
		$('.services-table .new-orders').html('<a class="dropdown-item" href="javascript: order_create_submit(\'table'+result.data.table[0].id+'\')"><i class="fas fa-clipboard"></i><span>'+$('.span-order').html()+'</span> </br><span>'+result.data.table[0].name+'</span></a>');	
	}
	
}

var table = new table();
