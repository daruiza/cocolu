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
		div.setAttribute("class", "col-sm-3");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");		
	    span.setAttribute("class", "");			    			    
	    span.innerHTML = 'x '+order_detail.products[obj][0].volume_sale;
	    div.appendChild(span);		    
	    subnode.appendChild(div);
		
		var div = document.createElement("div");
		div.setAttribute("class", "col-sm-9");		
		div.setAttribute("style", "text-align: center;"); 
		var span = document.createElement("span");
	    span.setAttribute("class", "");	    
	    span.innerHTML = order_detail.products[obj][0].name;
	    div.appendChild(span);		    
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
	  span.innerHTML = $( "input[name='input_volume']" ).val()+':'+order_detail.products[index][0].volume_sale;
	  div.appendChild(span);		    
	  subnode.appendChild(div);

	  
	  

	  node.appendChild(subnode);
	  modal.appendChild(node);
	  
	  $('#modal_detail').modal('toggle');
	});
};


var order_detail = new order_detail();