function order_detail() {	
	this.table_id;
	this.products = new Array();
}
	
order_detail.prototype.onjquery = function() {	
};

order_detail.prototype.orders_paint = function(container) {
	/*container es la ubicación donde pintar la orden*/

	//limpiamos el contenedor
	container.innerHTML = '';//limpiamos el modal
	sum = 0;

	var node = document.createElement("div");
    node.setAttribute("class", "container form-group");
	for(obj in order_detail.products) {

    	var subnode = document.createElement("div");    	
		if(obj%2){
			subnode.setAttribute("class", "row product_obj");
		}else{
			subnode.setAttribute("class", "row product_obj row-impar");
		}
		subnode.setAttribute("id", "order_product_"+obj);

		var div = document.createElement("div");
		div.setAttribute("class", "col-sm-2");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = 'x '+order_detail.products[obj][0].volume_sale;
	    div.appendChild(span);		    
	    subnode.appendChild(div);
		
		var div = document.createElement("div");
		div.setAttribute("class", "col-sm-10");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");
	    span.setAttribute("class", "");	    
	    span.innerHTML = order_detail.products[obj][0].name;
	    div.appendChild(span);

	    //en caso de existir un ingrediente compuesto
	    for(index in order_detail.products[obj][1]){
	    	if(Array.isArray(order_detail.products[obj][1][index])){				
	    		for(i in order_detail.products[obj][1][index]){
	    			if(order_detail.products[obj][1][index][i].value_selected){
	    				var span = document.createElement("span");
					    span.setAttribute("class", "");	    
					    span.innerHTML = ' '+order_detail.products[obj][1][index][i].product;
					    div.appendChild(span);			    
	    			}
	    		}
				
	    	}
	    }

	    subnode.appendChild(div);

	    var div = document.createElement("div");
		div.setAttribute("class", "col-sm-12");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");
	    span.setAttribute("class", "");			    			    
	    var total = order_detail.products[obj][0].volume_sale * order_detail.products[obj][0].price;
	    span.innerHTML = '$ '+total;
	    div.appendChild(span);		    
	    subnode.appendChild(div);

	    node.appendChild(subnode);

	    sum = sum + total;


	    //Luego pintamos los campos ocultos para el form al servidor
	    var input = document.createElement("input");
	    input.setAttribute("type", "hidden");	    
	    input.setAttribute("name", "prod_"+order_detail.products[obj][0].id);
	    input.setAttribute("value", order_detail.products[obj][0].volume_sale);   	    
	    node.appendChild(input);
	    //agregamos los ingredientes
	    for(index in order_detail.products[obj][1]){
	    	//primero los que no estan compuestos
	    	if(!Array.isArray(order_detail.products[obj][1][index])){
	    		var input = document.createElement("input");
			    input.setAttribute("type", "hidden");	    
			    input.setAttribute("name", "ingr_"+order_detail.products[obj][0].id+'_'+order_detail.products[obj][1][index].ingredient_id);
			    input.setAttribute("value", order_detail.products[obj][1][index].value_checked);   	    
			    node.appendChild(input);

			    var input = document.createElement("input");
			    input.setAttribute("type", "hidden");	    
			    input.setAttribute("name", "sugg_"+order_detail.products[obj][0].id+'_'+order_detail.products[obj][1][index].ingredient_id);
			    input.setAttribute("value", order_detail.products[obj][1][index].value_suggestion);   	    
			    node.appendChild(input);

	    	}else{
	    		for(i in order_detail.products[obj][1][index]){
	    			if(order_detail.products[obj][1][index][i].value_selected){
	    				var span = document.createElement("span");
					    span.setAttribute("class", "");	    
					    span.innerHTML = ' '+order_detail.products[obj][1][index][i].product;
					    div.appendChild(span);			    
	    			}

	    			var input = document.createElement("input");
				    input.setAttribute("type", "hidden");	    
				    input.setAttribute("name", "grou_"+order_detail.products[obj][0].id+'_'+order_detail.products[obj][1][index][i].ingredient_id+'_'+order_detail.products[obj][1][index][i].group);
				    input.setAttribute("value", order_detail.products[obj][1][index][i].value_selected);   	    
				    node.appendChild(input);
	    		}
	    	}
	    	
	    }
	}

	container.appendChild(node);

	var node = document.createElement("div");
    node.setAttribute("class", "container form-group");

    var subnode = document.createElement("div");
	subnode.setAttribute("class", "row");

    var div = document.createElement("div");
	div.setAttribute("class", "col-sm-12");		
	div.setAttribute("style", "text-align: center;"); 
	var span = document.createElement("span");
    span.setAttribute("class", "");			    			        
    span.innerHTML = 'Total $'+sum;
    div.appendChild(span);		    
    subnode.appendChild(div);

    node.appendChild(subnode);	
    container.appendChild(node);
	
	//es mejor crearlo aqui que se tienen todas las variables
    $( ".product_obj" ).on( "click", function() {
	  //alert(this.id);
	  //seteado de informacion al modal
	  var modal = $('#modal_detail .card-body')[0];	  
	  modal.innerHTML = '';//limpiamos el modal
	  var index = this.id.split("_")[2];
	  $('#modal_detail .detail-name').html(order_detail.products[index][0].name);

	  var node = document.createElement("div");
	  node.setAttribute("class", "container");

	  var input = document.createElement("input");	    
	  input.setAttribute("type", "hidden");
	  input.setAttribute("id", "id_ingredient");
	  input.setAttribute("name", "id_"+order_detail.products[index][0].id);
	  input.setAttribute("value", order_detail.products[index][0].id);   	    
	  node.appendChild(input);

	  var input = document.createElement("input");	    
	  input.setAttribute("type", "hidden");
	  input.setAttribute("id", "index_ingredient");
	  input.setAttribute("name", "index_"+index);
	  input.setAttribute("value", index);   	    
	  node.appendChild(input);

	  var subnode = document.createElement("div");
	  subnode.setAttribute("class", "row");

	  var div = document.createElement("div");
	  div.setAttribute("class", "col-sm-3");		
	  div.setAttribute("style", ""); 
	  var span = document.createElement("span");
	  span.setAttribute("class", "");
	  span.innerHTML = order_detail.products[index][0].name;
	  div.appendChild(span);		    
	  subnode.appendChild(div);

	  var div = document.createElement("div");
	  div.setAttribute("class", "col-sm-3");		
	  div.setAttribute("style", ""); 
	  var span = document.createElement("span");
	  span.setAttribute("class", "");
	  span.innerHTML = $( "input[name='input_price']" ).val()+': $'+order_detail.products[index][0].price;
	  div.appendChild(span);		    
	  subnode.appendChild(div);

	  var div = document.createElement("div");
	  div.setAttribute("class", "col-sm-3");		
	  div.setAttribute("style", ""); 
	  var span = document.createElement("span");
	  span.setAttribute("class", "");
	  span.innerHTML = $( "input[name='input_volume']" ).val()+':'+order_detail.products[index][0].volume_sale;
	  div.appendChild(span);		    
	  subnode.appendChild(div);

	  var div = document.createElement("div");
	  div.setAttribute("class", "col-sm-3");		
	  div.setAttribute("style", ""); 
	  var span = document.createElement("span");
	  span.setAttribute("class", "");
	  span.innerHTML = 'Total'+':'+(order_detail.products[index][0].volume_sale*order_detail.products[index][0].price);
	  div.appendChild(span);		    
	  subnode.appendChild(div);
	  
	  node.appendChild(subnode);

	  var subnode = document.createElement("div");
	  subnode.setAttribute("class", "row");

	  var div = document.createElement("div");
	  div.setAttribute("class", "col-sm-4");
	  div.setAttribute("style", "align-items: center; justify-content: center; display: flex;");
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
	  input.setAttribute("name", "new_volume_"+order_detail.products[index][0].id);
	  input.setAttribute("value", order_detail.products[index][0].volume_sale);
	  div.appendChild(input);
	  subnode.appendChild(div);

	  node.appendChild(subnode);
	  
	  modal.appendChild(node);
	  
	  $('#modal_detail').modal('toggle');

	  //bon editar del modal
	  $( "#modal_detail .btn-edit" ).on( "click", function() {
	  	var index = parseInt($('#modal_detail #index_ingredient').val());
	  	var id = parseInt($('#modal_detail #id_ingredient').val());
	  	//validamo que si exista el id
	  	if(order_detail.products[index][0].id = id){	  		
	  		order_detail.products[index][0].volume_sale = parseInt($("input[name='new_volume_"+id+"']").val())
	  		//llamado a pintador de las ordenes
			order_detail.orders_paint($("#modal_order_create .orders")[0]);
	  	}else{	  		
	  		alert($( "input[name='error_ingredient_edit']" ).val());
	  	}

	  });

	  $( "#modal_detail .btn-delete" ).on( "click", function() {
	  	var index = parseInt($('#modal_detail #index_ingredient').val());
	  	var id = parseInt($('#modal_detail #id_ingredient').val());
	  	order_detail.products.splice(index, 1);
	  	//llamado a pintador de las ordenes
		order_detail.orders_paint($("#modal_order_create .orders")[0]);
	  });

	});
};

var order_detail = new order_detail();