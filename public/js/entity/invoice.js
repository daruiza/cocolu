function invoice() {	
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
    node.setAttribute("class", "form-group row");

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
    /*
    for(var i=0;i<products.childElementCount;i++){
        var opt = products.options[i];
        var opt1 = document.createElement('option');   
        opt1.value = opt.value;
        opt1.innerHTML = opt.innerHTML;
        select.appendChild(opt1);
    }
    */  

    subnode.appendChild(select);
    node.appendChild(subnode);

    cn.appendChild(node);

    $('.chosen-select').chosen();
    $('.chosen-container').width('100%');

};

var invoice = new invoice();