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

	for(var i=0;i<alert_events.events.length;i++){
		//evento tipo orden
		if(("order" in alert_events.events[i])){			
			var node = document.createElement("div");
        	node.setAttribute("class", "li-order-event-alert");	
        	node.innerHTML = 'event '+i;
			cn.appendChild(node);
		}
	}

};


alert_events.prototype.showEvents = function(event){
    //usamos el contenedor de alertas, para agregar un nuevo evento
    if(("order" in event)){            
        //abemus order, mostramos el mesero, la mesa, y un         
        var cn=document.getElementsByClassName("ul-content")[0];
        var node = document.createElement("li");
        node.setAttribute("class", "li-order-event-alert");

        var subnode = document.createElement("a");
        subnode.setAttribute("class", "");
        subnode.setAttribute("href", "table");
        subnode.setAttribute("onclick", "store.clearEvents()");

        var div = document.createElement("div");
        div.setAttribute("class", "");
        div.innerHTML = $( "input[name='messageNeworder']").val();
        subnode.appendChild(div);        
        node.appendChild(subnode);

        var div = document.createElement("div");
        div.setAttribute("class", "");
        div.innerHTML = $( "input[name='messageWaiter']").val()+': '+event.user.name+' '+event.user.surname;
        node.appendChild(div);        

        var div = document.createElement("div");
        div.setAttribute("class", "");
        div.innerHTML = $( "input[name='messageTable']").val()+': '+event.table.name;
        node.appendChild(div);        

        var div = document.createElement("div");
        div.setAttribute("class", "");
        div.innerHTML = $( "input[name='messageOrder']").val()+': Serial-'+event.order.serial+ ' '+ $( "input[name='messageHour']").val()+' -'+event.order.date.substring(11,16);
        node.appendChild(div);
        
        
        cn.appendChild(node);
    }    

    //1. Mostramos los eventos
    if(!$('.alert-events').is(':visible'))$('.alert-events').toggle();    
}

var alert_events = new alert_events();