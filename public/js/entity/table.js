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

table.prototype.returnAddProduct = function(result) {
	

	$('#modal_order_conponents .product-name').html(result.data[0].name);
	var modal = $('#modal_order_conponents .card-body')[0];
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

	//add to array order_details whitout repeat
	order_detail.products.push(result.data);

	modal.appendChild(node);		

	$('#modal_order_conponents').modal('toggle');
}

var table = new table();
