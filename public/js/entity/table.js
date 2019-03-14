function table() {	
}
	
table.prototype.onjquery = function() {		
	table.selectTable('object-table','selected-table');	
};

table.prototype.selectTable = function(objectClass,selectClass) {
    $('.'+objectClass).click(function() {
    	//clear service menu
		$('.services-table .table').html('');
		$('.services-table .orders').html('');
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

	var orders = $('.services-table .orders')[0];	  
	orders.innerHTML = '';//limpiamos el modal

	var node = document.createElement("div");
    node.setAttribute("class", "form-group");

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");	    
    input.setAttribute("name", "order_store_id");
    input.setAttribute("value", result.data.request.store_id);   	    
    node.appendChild(input);

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");	    
    input.setAttribute("name", "order_table_id");
    input.setAttribute("value", result.data.request.table_id);   	    
    node.appendChild(input);

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");	    
    input.setAttribute("name", "order_service_id");
    input.setAttribute("value", result.data.service[0].id);   	    
    node.appendChild(input);

    for(obj in result.data.orders) {
    	var subnode = document.createElement("div");
		if(result.data.orders[obj].status_id == 1){
			subnode.setAttribute("class", "row order-obj status-one");
		}

		subnode.setAttribute("id", "order-"+result.data.orders[obj].id);		
		var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "order_id");
	    input.setAttribute("value", result.data.orders[obj].id);   	    
	    subnode.appendChild(input);

		var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "description");
	    input.setAttribute("value", result.data.orders[obj].description);   	    
	    subnode.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "waiter");
	    input.setAttribute("value", result.data.orders[obj].waiter);   	    
	    subnode.appendChild(input);

		var div = document.createElement("div");
		div.setAttribute("class", "col-sm-12 date");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = result.data.orders[obj].date;
	    div.appendChild(span);		    
	    subnode.appendChild(div);
		
		var div = document.createElement("div");
		div.setAttribute("class", "col-sm-5 serial");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = 'Serial: '+result.data.orders[obj].serial;
	    div.appendChild(span);		    
	    subnode.appendChild(div);
	    
		var div = document.createElement("div");
		div.setAttribute("class", "col-sm-7 status");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = result.data.orders[obj].status;
	    div.appendChild(span);		    
	    subnode.appendChild(div);

	    node.appendChild(subnode);
    }
	orders.appendChild(node);
	//Orden solo si hay servicio
	if(result.data.service.length){
		$('.services-table .new-orders').html('<a class="dropdown-item" href="javascript: order_create_submit(\'table'+result.data.table[0].id+'\')"><i class="fas fa-clipboard"></i><span>'+$('.span-order').html()+'</span></a>');	
	}

	$('.order-obj').on( "click", function() {
		//result.data.orders[0].date
		$('#modal_order_view .modal-title-subtext').html($('#'+this.id+" .serial")[0].children[0].innerHTML+" ["+$('#'+this.id+" .date")[0].children[0].innerHTML+"]");

		var modal = $('#modal_order_view .container')[0];	  
		modal.innerHTML = '';//limpiamos el modal

		var node = document.createElement("div");
    	node.setAttribute("class", "form-group");

		var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "store_id");
	    input.setAttribute("value", $( "input[name='order_store_id']" ).val());   	    
	    node.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "table_id");
	    input.setAttribute("value", $( "input[name='order_table_id']" ).val()); 	    
	    node.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "service_id");
	    input.setAttribute("value", $( "input[name='order_service_id']" ).val());
	    node.appendChild(input);


	    var subnode = document.createElement("div");    
	    subnode.setAttribute("class", "row");

	    var div = document.createElement("div");
		div.setAttribute("class", "col-sm-4");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = $( "input[name='mesage_state']" ).val()+' '+$('#'+this.id+" .status")[0].children[0].innerHTML;
	    div.appendChild(span);		    
	    subnode.appendChild(div);

	    node.appendChild(subnode);


	    modal.appendChild(node);
		$('#modal_order_view').modal('toggle');
	});
	
};

table.prototype.returnAddProduct = function(result) {	
	
	$('#modal_order_conponents .product-name').html(result.data[0].name);
	var modal = $('#modal_order_conponents .container')[0];
	var n = 0;//numero de ingredientes
	modal.innerHTML = '';//limpiamos el modal

	var node = document.createElement("div");
    node.setAttribute("class", "container form-group");

    var input = document.createElement("input");	    
    input.setAttribute("type", "hidden");
    input.setAttribute("id", "id_ingredient");
    input.setAttribute("name", "id_"+result.data[0].id);
    input.setAttribute("value", result.data[0].id);   	    
    node.appendChild(input);

    var subnode = document.createElement("div");
	subnode.setAttribute("class", "row");

	var div = document.createElement("div");
	div.setAttribute("class", "col-sm-4");
	div.setAttribute("style", "justify-content: center;");
	var span = document.createElement("span");
    span.setAttribute("class", "");			    			    
    span.innerHTML = $( "input[name='input_volume']" ).val();
    div.appendChild(span);		    
    subnode.appendChild(div);

    var div = document.createElement("div");
	div.setAttribute("class", "col-sm-8");
    var input = document.createElement("input");	    
    input.setAttribute("class", "form-control");
    input.setAttribute("name", "volume_"+result.data[0].id);
    div.appendChild(input);
    subnode.appendChild(div);

    node.appendChild(subnode);

	if(result.data[1].toString() != "" || result.data[1].length > 0){
	    //ingredientes compuestos
	    for(obj in result.data[1]) {
	    	if(Array.isArray(result.data[1][obj])){

	    		var subnode = document.createElement("div");
    			subnode.setAttribute("class", "row multi_ingredient");    			

    			var div = document.createElement("div");
    			div.setAttribute("class", "col-sm-4");
    			div.setAttribute("style", "justify-content: center;");
    			var span = document.createElement("span");
			    span.setAttribute("class", "");			    			    
			    span.innerHTML = result.data[1][obj][0].group;
			    div.appendChild(span);		    
			    subnode.appendChild(div);

			    var div = document.createElement("div");
    			div.setAttribute("class", "col-sm-8");
			    var select = document.createElement("select");
    			select.setAttribute("class", "form-control");
    			select.setAttribute("name", "ingredient_"+result.data[0].id+"_"+result.data[1][obj][0].product_id);
    			select.setAttribute("id", "ingredient_"+result.data[0].id+"_"+result.data[1][obj][0].product_id);

			    for(grp in result.data[1][obj]) {			    	
			        var opt1 = document.createElement('option');   
			        opt1.value = result.data[1][obj][grp].ingredient_id;
			        opt1.innerHTML = result.data[1][obj][grp].product;
			        select.appendChild(opt1);
			    }

			    div.appendChild(select);		    
			    subnode.appendChild(div);
    			node.appendChild(subnode);
	    	}
	    }

	    for(obj in result.data[1]) {
	    	if(!Array.isArray(result.data[1][obj])){

	    		var subnode = document.createElement("div");
    			subnode.setAttribute("class", "row ingredient");

    			var div = document.createElement("div");
    			div.setAttribute("class", "col-sm-1");
    			var input = document.createElement("input");
			    input.setAttribute("class", "form-control control-checkbox");
			    input.setAttribute("type", "checkbox");			    
			    input.checked = true;
			    input.setAttribute("name", "ingredient_"+result.data[0].id+"_"+result.data[1][obj].ingredient_id);
			    input.setAttribute("value", result.data[1][obj].ingredient_id);
			    div.appendChild(input);		    
			    subnode.appendChild(div);

			    var div = document.createElement("div");
    			div.setAttribute("class", "col-sm-5");
    			var span = document.createElement("span");
			    span.setAttribute("class", "");			    
			    span.innerHTML = result.data[1][obj].product+' - '+result.data[1][obj].volume+' '+result.data[1][obj].unity;
			    div.appendChild(span);		    
			    subnode.appendChild(div);

			    var div = document.createElement("div");
    			div.setAttribute("class", "col-sm-6");
    			var input = document.createElement("input");
			    input.setAttribute("class", "form-control");
    			input.setAttribute("name", "ingredient_suggestion_"+result.data[1][obj].ingredient_id);
    			input.setAttribute("placeholder", $( "input[name='input_placeholder_suggestion']" ).val());  
			    div.appendChild(input);		    
			    subnode.appendChild(div);
			    			   
    			node.appendChild(subnode);
	    		//console.log(result.data[1][obj]);
	    	}
		}		
	}

	//add to array order_details
	order_detail.products.push(result.data);

	modal.appendChild(node);		

	$('#modal_order_conponents').modal('toggle');
};

var table = new table();
