function alert_events() {
	this.events = [];
	this.onjquery();    
}

//evita que se borre el contenedor de eventos
alert_events.prototype.onjquery = function() {
	//para que no borre el contenedor de alertas
	$('.alert-events').on("close.bs.alert", function () {
	    $('.alert-events').hide();	    
	    return false;
	});

	//al abrir la opcion de alertas
	$('.alert-option').on('show.bs.dropdown', function () {
		
		$('.alert-option a .badge').removeClass('new-event');		
		$('.alert-option a .fa-bell').removeClass('new-event');
		$('.alert-option a .fa-bell').removeClass('fa-spin');		
		$('.alert-option a .badge').html('');

		alert_events.showAlerts();

	});

	//al cerrar la opcion de alertas
	$('.alert-option').on('hide.bs.dropdown', function () {
        $('.alert-option .dropdown-content').html('');
    });
};

alert_events.prototype.addEvent = function(event){
	//add event
	alert_events.events.push(event);
	//add badge
	$('.alert-option a .badge').addClass('new-event');
	$('.alert-option a .badge').html(alert_events.events.length);

	//change class alert bell
	$('.alert-option a .fa-bell').addClass('fa-spin');
	$('.alert-option a .fa-bell').addClass('new-event');	
};

alert_events.prototype.showAlerts = function(event){
	//construccion de los eventos
	var cn=document.getElementsByClassName("dropdown-content")[0];

	for(var i=alert_events.events.length-1;i>=0;i--){
		//evento tipo orden
		if(("order" in alert_events.events[i])){			
			var node = document.createElement("div");
        	node.setAttribute("class", "alert alert-danger alert-dismissible");
        	
			var subnode = document.createElement("a");
	        subnode.setAttribute("class", "");
	        subnode.setAttribute("href", "table");        	
        	var subsubnode = document.createElement("h6");
        	subsubnode.setAttribute("class","alert-heading");
        	subsubnode.innerHTML = $("input[name='messageNeworder']").val();
        	subnode.appendChild(subsubnode);
        	node.appendChild(subnode);

        	var subnode = document.createElement("a");
        	subnode.setAttribute("href","#");
        	subnode.setAttribute("id","event_"+i);
        	subnode.setAttribute("class","close");
        	subnode.setAttribute("data-dismiss","alert");
        	subnode.setAttribute("aria-label","close");
        	subnode.innerHTML = "&times";
        	node.appendChild(subnode);

        	var subnode = document.createElement("hr");
        	node.appendChild(subnode);

        	var subnode = document.createElement("div");
	        subnode.setAttribute("class", "");	        
	        subnode.innerHTML = $( "input[name='messageTable']").val()+': '+alert_events.events[i].table.name;        	
        	node.appendChild(subnode);

        	var div = document.createElement("div");
        	div.setAttribute("class", "");
        	div.innerHTML = $( "input[name='messageWaiter']").val()+': '+alert_events.events[i].user.name+' '+alert_events.events[i].user.surname;
        	node.appendChild(div);

        	var div = document.createElement("div");
        	div.setAttribute("class", "");
        	div.innerHTML = $( "input[name='messageOrder']").val()+': Serial-'+alert_events.events[i].order.serial+ ' '+ $( "input[name='messageHour']").val()+' -'+alert_events.events[i].order.date.substring(11,16);
        	node.appendChild(div);        

        	
			cn.appendChild(node);
			//add function on close event
		}

		if(("message" in alert_events.events[i])){
			var node = document.createElement("div");
        	node.setAttribute("class", "alert alert-info alert-dismissible");        	
			
        	var subnode = document.createElement("h6");
        	subnode.setAttribute("class","alert-heading");
        	subnode.innerHTML = $("input[name='messageNewmessage']").val();        	
        	node.appendChild(subnode);

        	var subnode = document.createElement("a");
        	subnode.setAttribute("href","#");
        	subnode.setAttribute("id","event_"+i);
        	subnode.setAttribute("class","close");
        	subnode.setAttribute("data-dismiss","alert");
        	subnode.setAttribute("aria-label","close");
        	subnode.innerHTML = "&times";
        	node.appendChild(subnode);

        	var subnode = document.createElement("hr");
        	node.appendChild(subnode);

        	var subnode = document.createElement("div");
	        subnode.setAttribute("class", "");	        
	        subnode.innerHTML = alert_events.events[i].message;        	
        	node.appendChild(subnode);

        	var div = document.createElement("div");
        	div.setAttribute("class", "");
        	div.innerHTML = $( "input[name='messageWaiter']").val()+': '+alert_events.events[i].user.name+' '+alert_events.events[i].user.surname;
        	node.appendChild(div);

        	cn.appendChild(node);		
		}
	}

};


var alert_events = new alert_events();