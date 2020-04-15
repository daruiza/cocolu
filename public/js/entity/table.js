function table() {	
}
	
table.prototype.onjquery = function() {		
	table.selectTable('object-table','selected-table');
	//para hacer focus a cualquier modal dentro de table	
};

table.prototype.selectTable = function(objectClass,selectClass) {
    $('.'+objectClass).click(function() {
    	//clear service menu
		$('.services-table .table').html('');
		$('.services-table .orders_menu').html('');
		$('.services-table .new-orders').html('');

        if($(this).hasClass(selectClass)){            
            $('.'+objectClass).removeClass(selectClass);        
            $( "input[name='id']" ).val('');
            //go to home or go to orders status ones
            window.location=$('#form-table-home').attr('action');
            
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

	var orders = $('.services-table .orders_menu')[0];	  
	orders.innerHTML = '';//limpiamos el modal

	var node = document.createElement("div");
    node.setAttribute("class", "form-group");

    var sum_service = 0;
    var sum_order_paid = 0;
    var sum_order_print = 0;   

    for(obj in result.data.orders) {
    	var subnode = document.createElement("div");
		
		subnode.setAttribute("class", "row order-obj status-"+result.data.orders[obj].status+" menu-status-"+result.data.orders[obj].status+" ");
		
		subnode.setAttribute("id", "order-"+result.data.orders[obj].id);

		var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "order_store_id"+"-order-"+result.data.orders[obj].id);
	    input.setAttribute("value", result.data.request.store_id);   	    
	    subnode.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "order_table_id"+"-order-"+result.data.orders[obj].id);
	    input.setAttribute("value", result.data.request.table_id);   	    
	    subnode.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "order_service_id"+"-order-"+result.data.orders[obj].id);
	    input.setAttribute("value", result.data.service[0].id);   	    
	    subnode.appendChild(input);		
		
		var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "order_id");
	    input.setAttribute("value", result.data.orders[obj].id);   	    
	    subnode.appendChild(input);

		var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "order_description");
	    input.setAttribute("value", result.data.orders[obj].description);   	    
	    subnode.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "order_product");
	    input.setAttribute("value", result.data.order_product[result.data.orders[obj].id]);   	    
	    subnode.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "order_waiter");
	    input.setAttribute("value", result.data.orders[obj].waiter);   	    
	    subnode.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "order_status");
	    input.setAttribute("value", result.data.orders[obj].status_id);   	    
	    subnode.appendChild(input);

	    /*
	    var div = document.createElement("div");
		div.setAttribute("class", "col-sm-12");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = result.data.table[0].name;
	    div.appendChild(span);		    
	    subnode.appendChild(div);
	    */

	    var div = document.createElement("div");
		div.setAttribute("class", "col-sm-7 status");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = $( "input[name='mesage_"+result.data.orders[obj].status+"']" ).val();
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
		div.setAttribute("class", "col-sm-12 date");		
		div.setAttribute("style", "text-align: center;");
		if(result.data.orders[obj].status_id == 3 || result.data.orders[obj].status_id == 4)div.setAttribute("style", "text-decoration: line-through;");		
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = "SubTotal: $"+parseInt(result.data.orders[obj].order_price).toLocaleString();
	    div.appendChild(span);		    
	    subnode.appendChild(div);

		var div = document.createElement("div");
		div.setAttribute("class", "col-sm-12 date");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = result.data.orders[obj].date;
	    div.appendChild(span);		    
	    subnode.appendChild(div);

	    node.appendChild(subnode);

	    if(result.data.orders[obj].status_id == 1 || result.data.orders[obj].status_id == 2){
	    	sum_service = sum_service + parseInt(result.data.orders[obj].order_price);
	    }

	    //ordenes servidas, listas para pagar
	    if(result.data.orders[obj].status_id == 2){
	    	sum_order_paid = sum_order_paid+1;
	    }

	    //ordenes pagas listas para imprimir
	    if(result.data.orders[obj].status_id == 3){
	    	sum_order_print = sum_order_print+1;
	    }
    }

    //totals    
    var div = document.createElement("div");
	div.setAttribute("class", "col-sm-12 date");		
	div.setAttribute("style", "text-align: center;"); 
	var span = document.createElement("span");		
    span.setAttribute("class", "");			    			    
    span.innerHTML = "Total: $"+sum_service.toLocaleString();
    div.appendChild(span);		      	    
    node.appendChild(div);

	orders.appendChild(node);

	$(".totals-orders").html("Total: $"+sum_service.toLocaleString());

	//Orden Boton nueva orden solo si hay servicio
	if(result.data.service.length ){
		$('.services-table .new-orders').html('<a class="dropdown-item" href="javascript: order_create_submit(\'table'+result.data.table[0].id+'\')"><i class="fas fa-clipboard"></i><span>'+$('.span-order').html()+'</span></a>');	
	}

	if(sum_order_paid){
		$('.services-table .new-orders').html($('.services-table .new-orders').html()+'<a class="dropdown-item" href="javascript: order_paid_submit(\'table_order_paid'+result.data.table[0].id+'\')"><i class="fas fa-money-check-alt"></i><span>'+$( "input[name='mesage_orderPaid']" ).val()+'</span></a>');	
	}

	if(sum_order_print){
		$('.services-table .new-orders').html($('.services-table .new-orders').html()+'<a class="dropdown-item" href="javascript: order_print_submit(\'table_order_print'+result.data.table[0].id+'\')"><i class="fas fa-print"></i><span>'+$( "input[name='mesage_orderPrint']" ).val()+'</span></a>');	
	}

	//pintar el modal
	order.showOrderModal();
	

	//cambio de opción deacuerdo a si tiene un servicio abierto
	if(result.data.service.length){
		$('.option-service span').html($( "input[name='mesage_closeService']" ).val());
		//$( "input[name='mesage_closeService']" ).val();
	}else{
		$('.option-service span').html($( "input[name='mesage_openService']" ).val());
		
	}
	
};

table.prototype.orderPaidResponse = function(result) {

	$('#modal_order_view .modal-title-subtext').html(result.data.table[0].name);
	var modal = $('#modal_order_view .container')[0];	  
	modal.innerHTML = '';//limpiamos el modal

	var node = document.createElement("div");
	node.setAttribute("class", "form-group");

	var input = document.createElement("input");
    input.setAttribute("type", "hidden");	    
    input.setAttribute("name", "store_id");
    input.setAttribute("value", result.data.request.store_id);   	    
    node.appendChild(input);	    

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");	    
    input.setAttribute("name", "table_id");
    input.setAttribute("value", result.data.request.table_id); 	    
    node.appendChild(input);

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");	    
    input.setAttribute("name", "next_status");
    input.setAttribute("value", 3); 	    
    node.appendChild(input);

    var subnode = document.createElement("div");    
    subnode.setAttribute("class", "row");

    var subsubnode = document.createElement("div");
    subsubnode.setAttribute("class", "col-sm-12");
    subsubnode.setAttribute("style","display: flex;flex-wrap: wrap;")   

    var div = document.createElement("div");
	div.setAttribute("class", "col-sm-1");
	div.setAttribute("style", "text-align: center;");						
	var input = document.createElement("input");
	input.setAttribute("type", "checkbox");	
	//input.setAttribute("checked", "checked");	
	input.setAttribute("autofocus", "autofocus");	
	input.setAttribute("name", "")		;
    input.setAttribute("class","form-control control-checkbox-header")	
    div.appendChild(input);
	subsubnode.appendChild(div);
    
    var div = document.createElement("div");
	div.setAttribute("class", "col-sm-11");		
	div.setAttribute("style", "text-align: center;"); 
	var span = document.createElement("span");		
    span.setAttribute("class", "");			    			    
    span.innerHTML ="<b>"+$( "input[name='mesage_producs']" ).val().toUpperCase()+"</b>";
    div.appendChild(span);
    subsubnode.appendChild(div);

    subnode.appendChild(subsubnode);

    //funcionamiento de checkbox global
    var flat_checkbox = true;

    for(obj in result.data.order_product) {
		var subsubnode = document.createElement("div");    	
		if(obj%2){
			subsubnode.setAttribute("class", "col-sm-12 product_obj");
		}else{
			subsubnode.setAttribute("class", "col-sm-12 product_obj row-impar");
		}
		subsubnode.setAttribute("style","display: flex;flex-wrap: wrap")
		subsubnode.setAttribute("id", "order_product_"+obj);

		/*
		var input = document.createElement("input");
		input.setAttribute('type','hidden');
		input.setAttribute('name',"order_id-"+obj+"-"+result.data.order_product[obj].id);
		input.setAttribute('value',result.data.order_product[obj].id);
		subsubnode.appendChild(input);
		*/

		var div = document.createElement("div");
		div.setAttribute("class", "col-sm-1");
		div.setAttribute("style", "text-align: center;");						
		var input = document.createElement("input");
		input.setAttribute("type", "checkbox");
		input.setAttribute("name", "status_paid-"+obj+"-"+result.data.order_product[obj].id+"-"+result.data.order_product[obj].order_poduct_id)		
	    input.setAttribute("class","form-control control-checkbox")
	    if(result.data.order_product[obj].status_paid == 1){
	    	input.setAttribute("checked", "checked");
	    	input.setAttribute("style", "display: none;");
	    	//flat_checkbox = false;	
	    }		    
	    div.appendChild(input);			
	    subsubnode.appendChild(div);

	    var div = document.createElement("div");
		div.setAttribute("class", "col-sm-3");
		div.setAttribute("style", "text-align: center;");						
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = ' <b>X'+parseInt(result.data.order_product[obj].volume).toLocaleString()+'</b>';
	    div.appendChild(span);		    
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = '  '+result.data.order_product[obj].name;
	    div.appendChild(span);
	    subsubnode.appendChild(div);

	    var groups = JSON.parse(result.data.order_product[obj].ingredients)["groups"]
	    var div = document.createElement("div");
		div.setAttribute("class", "col-sm-3");
		div.setAttribute("style", "text-align: center;");
	    if(groups != undefined){		    	
	    	for(grp in groups){

	    		var subdiv = document.createElement("div");
				subdiv.setAttribute("class", "");					
	    		
				var span = document.createElement("span");
			    span.setAttribute("class", "");			    			    
			    span.innerHTML = ' '+groups[grp].name;
			    subdiv.appendChild(span);
			    div.appendChild(subdiv);
	    	}
	    }		    
	    subsubnode.appendChild(div);

	    var ingredients = JSON.parse(result.data.order_product[obj].ingredients)["ingredients"];
	    var div = document.createElement("div");
		div.setAttribute("class", "col-sm-3");
		div.setAttribute("style", "text-align: center;");
	    if(ingredients != undefined){		    	
	    	for(ing in ingredients){

	    		if(ingredients[ing].suggestion != null){

	    			var subdiv = document.createElement("div");
					subdiv.setAttribute("class", "");	

	    			var span = document.createElement("span");		
				    span.setAttribute("class", "");			    			    
				    span.innerHTML = ingredients[ing].name+' - '+ingredients[ing].suggestion;
				    subdiv.appendChild(span);

				    div.appendChild(subdiv);	    				    
	    		}

			    if(ingredients[ing].value == "false"){

					var subdiv = document.createElement("div");
					subdiv.setAttribute("class", "");	

					var span = document.createElement("span");		
				    span.setAttribute("class", "");			    			    
				    span.innerHTML = $( "input[name='mesage_without']" ).val()+' '+ingredients[ing].name;
				    subdiv.appendChild(span);		    				    				   

				    if(ingredients[ing].suggestion != null){
				    	var span = document.createElement("span");		
					    span.setAttribute("class", "");			    			    
					    span.innerHTML = ' - '+ingredients[ing].suggestion;
					    subdiv.appendChild(span);		    				    
				    }
				    div.appendChild(subdiv);
			    }
	    	}
	    }
	    subsubnode.appendChild(div);
	    subnode.appendChild(subsubnode);

	    //TOTALES
	    var div = document.createElement("div");
		div.setAttribute("class", "col-sm-2");
		div.setAttribute("style", "text-align: center;");	

	    var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = '$'+parseInt(result.data.order_product[obj].price).toLocaleString();
	    div.appendChild(span);		    
	    //subsubnode.appendChild(div);

	    var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = ' - Total: $';
	    div.appendChild(span);		    
	    var span = document.createElement("span");		
	    span.setAttribute("class", "span-subtotal");			    			    
	    span.innerHTML = (parseInt(result.data.order_product[obj].price) * parseInt(result.data.order_product[obj].volume)).toLocaleString();
	    div.appendChild(span);
	    subsubnode.appendChild(div);
		
			
	}

	var subsubnode = document.createElement("div");
	subsubnode.setAttribute("class", "col-sm-12 last-div-total");		
    var div = document.createElement("div");
	div.setAttribute("class", "col-sm-12");		
	div.setAttribute("style", "text-align: center;"); 
	
	var span = document.createElement("span");		
    span.setAttribute("class", "");			    			    
    span.innerHTML = "Total: $";
    div.appendChild(span);
    var span = document.createElement("span");		
    span.setAttribute("class", "span-total");			    			    
    span.innerHTML = "0000";
    div.appendChild(span);		    
    subsubnode.appendChild(div);
    subnode.appendChild(subsubnode);

    
    node.appendChild(subnode);
    modal.appendChild(node);

	$('#modal_order_view .btn-send').html($( "input[name='mesage_pay']" ).val())
	$('#modal_order_view .btn-cancel').css('display','none');//ya no se puede cancelar

	$('#modal_order_view').modal('toggle');

	$('.control-checkbox').change(function() {
		if($(this).is(":checked")) {			
			$('.span-total').html(parseInt($('.span-total').html().replace(',',''))+parseInt($($(this).parent().parent().children()[4]).children()[2].innerHTML.replace('.','')));			
		}else{
			$('.span-total').html(parseInt($('.span-total').html().replace(',',''))-parseInt($($(this).parent().parent().children()[4]).children()[2].innerHTML.replace('.','')));			
		}
	});

	if(flat_checkbox){
		$('.control-checkbox-header').change(function(){
			/*solo los qu no esten ocultos*/
			for (var i = $( ".control-checkbox" ).length - 1; i >= 0; i--) {
				if($( ".control-checkbox" )[i].style.display != "none" ){
					$('.control-checkbox').attr('checked', $(this).is( ":checked" ));				
					$( ".control-checkbox" ).prop( "checked", $(this).is( ":checked" ) );
				}
					
			}
			//actualizamos el total

			var sum = 0;
			if($(this).is( ":checked" )){
				for(i=0;i<$( ".control-checkbox" ).length;i++){
					sum = sum + parseInt($($( ".control-checkbox" )[i]).parent().parent()[0].children[4].children[2].innerHTML.replace('.',''))	
				}	
			}

			$('.span-total').html(sum);		
			
		});	
	}
	
}

table.prototype.orderPrintResponse = function(result) {
	table.orderPaidResponse(result);
	$('#modal_order_view .btn-send').html($( "input[name='mesage_print']" ).val())
	$( "input[name='next_status']" ).val(6);
	
}

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
	subnode.setAttribute("class", "row form-group ");

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
    input.setAttribute("type", "number");
    input.setAttribute("class", "form-control");
    input.setAttribute("autofocus", "autofocus");    
    input.setAttribute("min", "0");
    input.setAttribute("name", "volume_"+result.data[0].id);
    input.value = "1";
    div.appendChild(input);
    subnode.appendChild(div);

    node.appendChild(subnode);

	if(result.data[1].toString() != "" || result.data[1].length > 0){
	    //ingredientes compuestos
	    for(obj in result.data[1]) {
	    	if(Array.isArray(result.data[1][obj])){

	    		var subnode = document.createElement("div");
    			subnode.setAttribute("class", "row multi_ingredient form-group ");    			

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
    			subnode.setAttribute("class", "row ingredient form-group");

    			var div = document.createElement("div");
    			div.setAttribute("class", "col-sm-2");
    			var input = document.createElement("input");
			    input.setAttribute("class", "form-control control-checkbox");
			    input.setAttribute("type", "checkbox");
			    input.checked = true;
			    input.setAttribute("id", "ingredient_"+result.data[0].id+"_"+result.data[1][obj].ingredient_id);	    			    
			    input.setAttribute("name", "ingredient_"+result.data[0].id+"_"+result.data[1][obj].ingredient_id);
			    input.setAttribute("value", result.data[1][obj].ingredient_id);
			    div.appendChild(input);		    
			    subnode.appendChild(div);

			    var div = document.createElement("div");
    			div.setAttribute("class", "col-sm-5");
    			div.setAttribute("for", "ingredient_"+result.data[0].id+"_"+result.data[1][obj].ingredient_id);			    
    			var span = document.createElement("span");
			    span.setAttribute("class", " ");			    
			    span.innerHTML = result.data[1][obj].product+' - '+result.data[1][obj].volume+' '+result.data[1][obj].unity;
			    div.appendChild(span);		    
			    subnode.appendChild(div);

			    var div = document.createElement("div");
    			div.setAttribute("class", "col-sm-5");
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

/*Controlador de scroll de modal  modal_order_conponents */
table.prototype.mouseWheel = function(evt,form,index) {
	//var name_input_volume = $($("#"+evt.target.id+" form")[0]).serializeArray()[1].name;;
	var name_input_volume = $("#"+form).serializeArray()[index].name;;
	if(evt.deltaY>0){
		if($( "input[name='"+name_input_volume+"']" ).val()>1){
			$( "input[name='"+name_input_volume+"']" ).val(
				parseInt($( "input[name='"+name_input_volume+"']" ).val())-1
			);	
		}		

	}else{
		$( "input[name='"+name_input_volume+"']" ).val(
			parseInt($( "input[name='"+name_input_volume+"']" ).val())+1
		);		
	}
}

var table = new table();
