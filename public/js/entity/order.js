function order() {
	
}
	
order.prototype.onjquery = function() {
	order.showOrderModal();	
};

order.prototype.showOrderModal = function() {
	$('.order-obj').on( "click", function() {
		//result.data.orders[0].date
		$('#modal_order_view .modal-title-subtext').html($('#'+this.id+" .serial")[0].children[0].innerHTML+" ["+$('#'+this.id+" .date")[0].children[0].innerHTML+"]");

		var modal = $('#modal_order_view .container')[0];	  
		modal.innerHTML = '';//limpiamos el modal
		$('#modal_order_view .container-destroy')[0].innerHTML='';//Limpiamos el form destroy

		var node = document.createElement("div");
		node.setAttribute("class", "form-group");

		var node_destroy = document.createElement("div");
		node_destroy.setAttribute("class", "form-group");

		var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "store_id");
	    input.setAttribute("value", $("input[name='order_store_id-"+this.id+"']" ).val());   	    
	    node.appendChild(input);	    

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "store_id");
	    input.setAttribute("value", $("input[name='order_store_id-"+this.id+"']" ).val());   	    
	    node_destroy.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "table_id");
	    input.setAttribute("value", $( "input[name='order_table_id-"+this.id+"']" ).val()); 	    
	    node.appendChild(input);
	    
	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "table_id");
	    input.setAttribute("value", $( "input[name='order_table_id-"+this.id+"']" ).val()); 	    
	    node_destroy.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "service_id");
	    input.setAttribute("value", $( "input[name='order_service_id-"+this.id+"']" ).val());
	    node.appendChild(input);
	    
	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "service_id");
	    input.setAttribute("value", $( "input[name='order_service_id-"+this.id+"']" ).val());
	    node_destroy.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "order_id");
	    input.setAttribute("value", $('#'+this.id+" input[name='order_id']" ).val());
	    node.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "order_id");
	    input.setAttribute("value", $('#'+this.id+" input[name='order_id']" ).val());
	    node_destroy.appendChild(input);

	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "next_status");
	    input.setAttribute("value", parseInt($( '#'+this.id+" input[name='order_status']" ).val())+1);
	    node.appendChild(input);
	    
	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "next_status");
	    input.setAttribute("value", parseInt($( '#'+this.id+" input[name='order_status']" ).val())+1);
	    node_destroy.appendChild(input);

	    $('#modal_order_view .container-destroy')[0].appendChild(node_destroy);//agregamos al form destroy

	    var subnode = document.createElement("div");    
	    subnode.setAttribute("class", "row");

	    var div = document.createElement("div");
		div.setAttribute("class", "col-sm-12");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = $( "input[name='mesage_state']" ).val()+' '+$('#'+this.id+" .status")[0].children[0].innerHTML;
	    div.appendChild(span);		    
	    subnode.appendChild(div);

	    var div = document.createElement("div");
		div.setAttribute("class", "col-sm-12");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML ="<b>"+$( "input[name='mesage_producs']" ).val().toUpperCase()+"</b>";
	    div.appendChild(span);		    
	    subnode.appendChild(div);

	    var sum = 0;

	    var products = JSON.parse($('#'+this.id+" input[name='order_description']").val())
	    var order_product = JSON.parse($('#'+this.id+" input[name='order_product']").val())
	    for(obj in products){

	    	var subsubnode = document.createElement("div");    	
			if(obj%2){
				subsubnode.setAttribute("class", "col-sm-12 product_obj");
			}else{
				subsubnode.setAttribute("class", "col-sm-12 product_obj row-impar");
			}
			subsubnode.setAttribute("id", "order_product_"+obj);
			subsubnode.setAttribute("style", "display: flex;flex-wrap: wrap;");		
    		
    		if(parseInt($( '#'+this.id+" input[name='order_status']" ).val()) == 1){	
				var div = document.createElement("div");
				div.setAttribute("class", "col-sm-1");
				div.setAttribute("style", "text-align: center;");						
				var input = document.createElement("input");				
				input.setAttribute("type", "checkbox");
				input.setAttribute("name", "status_serve-"+obj+"-"+order_product[obj].id)		
			    input.setAttribute("class","form-control control-checkbox")
			    if(order_product[obj].status_serve == 1){
			    	input.setAttribute("checked", "checked");	
			    }		    
			    div.appendChild(input);			
			    subsubnode.appendChild(div);		    
			}else{
				
				if(parseInt($( '#'+this.id+" input[name='order_status']" ).val()) == 2){
					var div = document.createElement("div");
					div.setAttribute("class", "col-sm-1");
					div.setAttribute("style", "text-align: center;");						
					var input = document.createElement("input");
					input.setAttribute("type", "checkbox");
					input.setAttribute("name", "status_paid-"+obj+"-"+order_product[obj].id)		
				    input.setAttribute("class","form-control control-checkbox")
				    if(order_product[obj].status_paid == 1){
				    	input.setAttribute("checked", "checked");	
				    }		    
				    div.appendChild(input);			
				    subsubnode.appendChild(div);		    
				}

			}

	    	var div = document.createElement("div");
			div.setAttribute("class", "col-sm-3");
			div.setAttribute("style", "text-align: center;");						
			var span = document.createElement("span");		
		    span.setAttribute("class", "");			    			    
		    span.innerHTML = ' <b>X'+parseInt(products[obj].volume).toLocaleString()+'</b>';
		    div.appendChild(span);		    
			var span = document.createElement("span");		
		    span.setAttribute("class", "");			    			    
		    span.innerHTML = '  '+products[obj].name;
		    div.appendChild(span);
		    subsubnode.appendChild(div);		    

		    sum = sum + (parseInt(products[obj].price) * parseInt(products[obj].volume));

		    var div = document.createElement("div");
			div.setAttribute("class", "col-sm-3");
			div.setAttribute("style", "text-align: center;");
		    if(products[obj].groups != undefined){		    	
		    	for(grp in products[obj].groups){

		    		var subdiv = document.createElement("div");
					subdiv.setAttribute("class", "");					
		    		
					var span = document.createElement("span");
				    span.setAttribute("class", "");			    			    
				    span.innerHTML = ' '+products[obj].groups[grp].name;
				    subdiv.appendChild(span);		    				    

				    /*Descripcion de catidad
				    var span = document.createElement("span");		
				    span.setAttribute("class", "");			    			    
				    span.innerHTML = '  <b>X'+products[obj].groups[grp].volume_product+'</b>';
				    subdiv.appendChild(span);
				    */

				    /*descripcion de unidad
				    var span = document.createElement("span");		
				    span.setAttribute("class", "");			    			    
				    span.innerHTML = ' ['+products[obj].groups[grp].unity+']';
				    subdiv.appendChild(span);
				    */

				    div.appendChild(subdiv);
		    	}
		    }		    
		    subsubnode.appendChild(div);


		    var div = document.createElement("div");
			div.setAttribute("class", "col-sm-3");
			div.setAttribute("style", "text-align: center;");
		    if(products[obj].ingredients != undefined){		    	
		    	for(ing in products[obj].ingredients){

		    		if(products[obj].ingredients[ing].suggestion != null){

		    			var subdiv = document.createElement("div");
						subdiv.setAttribute("class", "");	

		    			var span = document.createElement("span");		
					    span.setAttribute("class", "");			    			    
					    span.innerHTML = products[obj].ingredients[ing].name+' - '+products[obj].ingredients[ing].suggestion;
					    subdiv.appendChild(span);

					    div.appendChild(subdiv);	    				    
		    		}

				    if(products[obj].ingredients[ing].value == "false"){

						var subdiv = document.createElement("div");
						subdiv.setAttribute("class", "");	

						var span = document.createElement("span");		
					    span.setAttribute("class", "");			    			    
					    span.innerHTML = $( "input[name='mesage_without']" ).val()+' '+products[obj].ingredients[ing].name;
					    subdiv.appendChild(span);		    				    

					    /*
					    var span = document.createElement("span");		
					    span.setAttribute("class", "");			    			    
					    span.innerHTML = '  <b>X'+products[obj].ingredients[ing].volume_product+'</b>';
					    subdiv.appendChild(span);	

					    var span = document.createElement("span");		
					    span.setAttribute("class", "");			    			    
					    span.innerHTML = ' ['+products[obj].ingredients[ing].unity+']';
					    subdiv.appendChild(span);		    				    
					    */

					    if(products[obj].ingredients[ing].suggestion != null){
					    	var span = document.createElement("span");		
						    span.setAttribute("class", "");			    			    
						    span.innerHTML = ' - '+products[obj].ingredients[ing].suggestion;
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
		    span.innerHTML = '$'+parseInt(products[obj].price).toLocaleString();
		    div.appendChild(span);		    
		    //subsubnode.appendChild(div);

		    var span = document.createElement("span");		
		    span.setAttribute("class", "");			    			    
		    span.innerHTML = ' - Total: $'+(parseInt(products[obj].price) * parseInt(products[obj].volume)).toLocaleString();
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
	    span.innerHTML = "Total: $"+sum.toLocaleString();
	    div.appendChild(span);		    
	    subsubnode.appendChild(div);
	    subnode.appendChild(subsubnode);

	    node.appendChild(subnode);
	    modal.appendChild(node);

	    //cambiamos los botones deacuerdo al estado

	    if(parseInt($( '#'+this.id+" input[name='order_status']" ).val()) == 1){
	    	$('#modal_order_view .btn-send').html($( "input[name='mesage_serve']" ).val())
	    	$('#modal_order_view .btn-send').css('display','block');
	    	$('#modal_order_view .btn-cancel').css('display','block');
	    }
	    //Orden Ok Entregada
	    if(parseInt($( '#'+this.id+" input[name='order_status']" ).val()) == 2){
	    	$('#modal_order_view .btn-send').html($( "input[name='mesage_pay']" ).val())
	    	$('#modal_order_view .btn-send').css('display','block');
	    	$('#modal_order_view .btn-cancel').css('display','block');//aun se puede cancelar
	    }

	    //Orden Pagada
	    if(parseInt($( '#'+this.id+" input[name='order_status']" ).val()) == 3){
	    	$('#modal_order_view .btn-send').css('display','none');
	    	$('#modal_order_view .btn-cancel').css('display','none');//ya no se puede cancelar

	    }

	    //orden cancelada
	    if(parseInt($( '#'+this.id+" input[name='order_status']" ).val()) == 4){
	    	$('#modal_order_view .btn-send').html($( "input[name='mesage_recover']" ).val())
	    	$('#modal_order_view .btn-send').css('display','block');
			$('#modal_order_view .btn-cancel').css('display','none');//ya no se puede cancelar	    	
	    }
	    

		$('#modal_order_view').modal('toggle');
	});
};


var order = new order();