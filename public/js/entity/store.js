function store() {    
}
	
store.prototype.onjquery = function() {	
};

store.prototype.consultaRespuestaCity = function(result) {    

    var list = document.getElementById("city");
    fistChild=list.firstChild;
    //limpiamos los hojos
    while (list.hasChildNodes()) {   
        list.removeChild(list.firstChild);
    }
    list.appendChild(fistChild);
    if(result.respuesta){
        if(result.data){            
            //añadimos nuevos elementos 

            Object.keys(result.data).forEach(function(key) {
                var option = document.createElement("option");
                option.value=key;
                option.textContent = result.data[key];
                list.appendChild(option);
            });
        }
    }
    
};

store.prototype.showEvents = function(event){
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

    console.log(event)

    //1. Mostramos los eventos
    if(!$('.alert-events').is(':visible'))$('.alert-events').toggle();    
}

store.prototype.clearEvents = function(){
    $('.alert-events .ul-content').html('');
    return true;
}


var store = new store();