function alert_events() {	
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
		
        var events = JSON.parse(sessionStorage.events);

		$('.alert-option a .badge').removeClass('new-event');		
		$('.alert-option a .fa-bell').removeClass('new-event');
		$('.alert-option a .fa-bell').removeClass('fa-spin');		
		$('.alert-option a .badge').html('');
        //abrir si hay eventos que mostrar
        if(events.length){
            alert_events.showAlerts();
            return true;
        }
        return false;
	});

	//al cerrar la opcion de alertas
	$('.alert-option').on('hide.bs.dropdown', function () {
        $('.alert-option .dropdown-content').html('');
        return alert_events.bandera_menu;
    });
};

alert_events.prototype.addEvent = function(event){
	//add event
    var events = JSON.parse(sessionStorage.events);
	events.push(event);
    sessionStorage.setItem('events', JSON.stringify(events));

	//add badge
	$('.alert-option a .badge').addClass('new-event');
	$('.alert-option a .badge').html(events.length);

	//change class alert bell
	$('.alert-option a .fa-bell').addClass('fa-spin');
	$('.alert-option a .fa-bell').addClass('new-event');	
};

alert_events.prototype.showAlerts = function(){
	//construccion de los eventos
	var cn=document.getElementsByClassName("dropdown-content")[0];
    var events = JSON.parse(sessionStorage.getItem('events'));

	for(var i=events.length-1;i>=0;i--){
		//evento tipo orden
		if(("order" in events[i])){			
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
	        subnode.innerHTML = $( "input[name='messageTable']").val()+': '+events[i].table.name;        	
        	node.appendChild(subnode);

        	var div = document.createElement("div");
        	div.setAttribute("class", "");
        	div.innerHTML = $( "input[name='messageWaiter']").val()+': '+events[i].user.name+' '+events[i].user.surname;
        	node.appendChild(div);

        	var div = document.createElement("div");
        	div.setAttribute("class", "");
        	div.innerHTML = $( "input[name='messageOrder']").val()+': Serial-'+events[i].order.serial+ ' '+ $( "input[name='messageHour']").val()+' -'+events[i].order.date.substring(11,16);
        	node.appendChild(div);        

        	
			cn.appendChild(node);
			//add function on close event
		}

		if(("message" in events[i])){
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
	        subnode.innerHTML = $( "input[name='messageIssue']").val()+': '+events[i].message.issue;        	
        	node.appendChild(subnode);

            var subnode = document.createElement("div");
            subnode.setAttribute("class", "");            
            subnode.innerHTML = events[i].message.body;            
            node.appendChild(subnode);

        	var div = document.createElement("div");
        	div.setAttribute("class", "");
        	div.innerHTML = $( "input[name='messageWaiter']").val()+': '+events[i].user.name+' '+events[i].user.surname;
        	node.appendChild(div);

        	cn.appendChild(node);		
		}
	}

    $('.alert-option .dropdown-content .alert').on('close.bs.alert', function () {        

        var events = JSON.parse(sessionStorage.getItem('events'));
        var i = this.children[1].id.split('_')[1];                
        events.splice(i, 1);
        sessionStorage.setItem('events', JSON.stringify(events));
    });

};


var alert_events = new alert_events();