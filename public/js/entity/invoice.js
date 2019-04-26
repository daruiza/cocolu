function invoice() {	    
    this.datos_providers = [];
}
	
invoice.prototype.onjquery = function() {	
};

invoice.prototype.selectObject = function(objectClass,selectClass) {
    $('.'+objectClass).click(function() {
        if($(this).hasClass(selectClass)){
            $('.'+objectClass).removeClass(selectClass);        
            $( "input[name='id']" ).val('');
            
        }else{
            $('.'+objectClass).removeClass(selectClass);        
            $(this).toggleClass(selectClass);
            $( "input[name='id']" ).val($(this)[0].children[0].value);               
           
        }
    });	
};

invoice.prototype.addProduct = function() {	
	var cn=document.getElementsByClassName("content-products")[0];
    var n=cn.childElementCount;

    var node = document.createElement("div");
    node.setAttribute("class", "col-md-12 row");
    node.setAttribute("style", "margin: 0px;margin-bottom: 5px;");

    var subnode = document.createElement("div");
    subnode.setAttribute("class", "col-sm-3 text-md-right");

    var input = document.createElement("input");
    input.setAttribute("class", "form-control");
    input.setAttribute("name", "item_volume_"+n);
    input.setAttribute("placeholder", $( "input[name='input_placeholder_volume']" ).val());

    subnode.appendChild(input);
    node.appendChild(subnode);

    var subnode = document.createElement("div");
    subnode.setAttribute("class", "col-sm-3 text-md-right");

    var input = document.createElement("input");
    input.setAttribute("class", "form-control");
    input.setAttribute("name", "item_price_"+n);
    input.setAttribute("placeholder", $( "input[name='input_placeholder_price']" ).val());  
    
    subnode.appendChild(input);
    node.appendChild(subnode);

    var subnode = document.createElement("div");
    subnode.setAttribute("class", "col-sm-6");
    
    var products = document.getElementById("products");
    var select = document.createElement("select");
    select.setAttribute("class", "form-control chosen-select");
    select.setAttribute("name", "item_product_"+n);

    var opt1 = document.createElement('option');    
    opt1.setAttribute('disabled','disabled');
    opt1.setAttribute('hidden','hidden');
    opt1.innerHTML = 'Elije un Producto...';
    
    for(var i=0;i<products.childElementCount;i++){
        var opt = products.options[i];
        var opt1 = document.createElement('option');   
        opt1.value = opt.value;
        opt1.innerHTML = opt.innerHTML;
        select.appendChild(opt1);
    }

    subnode.appendChild(select);
    node.appendChild(subnode);

    cn.appendChild(node);

    $('.chosen-select').chosen();
    $('.chosen-container').width('100%');

};

invoice.prototype.consultaRespuestaProvider = function(result) {
    if(result.data != null){
        //asignamos los datos
        $("input[name=name_provider]").val(result.data.name);
        $("input[name=adress_provider]").val(result.data.address);
        $("input[name=description_provider]").val(result.data.description);
        $("input[name=email_provider]").val(result.data.email);
        $("input[name=phone_provider]").val(result.data.phone);
        $("#img_provider_img")[0].setAttribute('src',$("#form_home").attr("action")+'/users/'+result.userid+'/providers/'+result.data.logo);        
        
    }else{
        //limpiamos los datos
        $("input[name=name_provider]").val('');
        $("input[name=adress_provider]").val('');
        $("input[name=description_provider]").val('');
        $("input[name=email_provider]").val('');
        $("input[name=phone_provider]").val('');
        $("#img_provider_img")[0].setAttribute('src',$("#form_home").attr("action")+'/images/providers/default.png');
    }

    $("input[name=number]").val('');
};


var invoice = new invoice();