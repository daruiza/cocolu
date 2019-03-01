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
			subnode.setAttribute("class", "row");
		}else{
			subnode.setAttribute("class", "row row-impar");
		}

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
};


var order_detail = new order_detail();