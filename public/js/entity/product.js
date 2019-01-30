function product() {	
}
	
product.prototype.onjquery = function() {	
};

product.prototype.selectObject = function(objectClass,selectClass) {
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

product.prototype.selectTable = function(objectClass,selectClass) {
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

product.prototype.addIngredient = function(objectClass,selectClass) {
    var cn=document.getElementsByClassName("inputs_ingredients")[0];
    var n=cn.childElementCount;

    //if(!n)$(document.getElementsByClassName("inputs_ingredients")).addClass("content-add-ingredient");

    var node = document.createElement("div");
    node.setAttribute("class", "form-group row");

    var subnode = document.createElement("div");
    subnode.setAttribute("class", "col-sm-4 text-md-right");

    var input = document.createElement("input");
    input.setAttribute("class", "form-control");
    input.setAttribute("name", "item_volume_"+n);   
    
    subnode.appendChild(input);
    node.appendChild(subnode);

    var subnode = document.createElement("div");
    subnode.setAttribute("class", "col-sm-8");
    
    var products = document.getElementById("products");
    var select = document.createElement("select");
    select.setAttribute("class", "form-control");
    select.setAttribute("name", "item_product_"+n);
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
}


var product = new product();