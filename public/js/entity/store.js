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
    //reiniciamos en chossen
    //$("#municipio").trigger("liszt:updated");
    //$("#city").trigger("chosen:updated");
};


var store = new store();