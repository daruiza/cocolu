$('#modal_order_create').modal('toggle');

//init order_detail
order_detail.table_id = $( "input[name='table_id']" ).val();
order_detail.products = new Array();

$('.option_add_product').on('click', function (e) {
	var datos = new Array();
	datos['id'] = this.id.split('_')[0];
	datos['store'] = this.id.split('_')[1];
	datos['name'] = this.id.split('_')[2];
	ajaxobject.peticionajax($('#form_add_product').attr('action'),datos,"table.returnAddProduct");				
});

$("#modal_order_conponents .btn-send").on('click', function (e) {	

	//actualizamos el product  en el orden array	
	for(obj in order_detail.products) {
		//search active product 
		if(order_detail.products[obj][0].id == $("#modal_order_conponents #id_ingredient").val() && 
			order_detail.products[obj][0].volume_sale == undefined ){
			
			order_detail.products[obj][0].volume_sale = parseInt($("input[name='volume_"+$("#modal_order_conponents #id_ingredient").val()+"']").val());
			
			//ingredients
			for(obj_ingredient in order_detail.products[obj][1]){
				//no compuesto
				if(!Array.isArray(order_detail.products[obj][1][obj_ingredient])){
					//input = $("input[value='"+order_detail.products[obj][1][obj_ingredient].ingredient_id)[0];	
					input = $("input[name='ingredient_"+order_detail.products[obj][0].id+"_"+order_detail.products[obj][1][obj_ingredient].ingredient_id)[0];	
					suggestion = $("input[name='ingredient_suggestion_"+order_detail.products[obj][1][obj_ingredient].ingredient_id)[0].value;	
					order_detail.products[obj][1][obj_ingredient].value_checked = input.checked;
					order_detail.products[obj][1][obj_ingredient].value_suggestion = suggestion;
				}else{
					var select = $("#ingredient_"+order_detail.products[obj][0].id+"_"+order_detail.products[obj][1][obj_ingredient][0].product_id);
					for(obj_array in order_detail.products[obj][1][obj_ingredient]){
						order_detail.products[obj][1][obj_ingredient][obj_array].value_selected = select[0].options[obj_array].selected;						
					}
				}
			}
		}
	}

	//limpiamos el array
	for(obj in order_detail.products) {
		if(order_detail.products[obj][0].volume_sale == undefined || order_detail.products[obj][0].volume_sale == 0 || isNaN(order_detail.products[obj][0].volume_sale)){			
			order_detail.products.splice(obj, 1);
		}
	}

	//llamado a pintador de las ordenes
	order_detail.orders_paint($("#modal_order_create .orders")[0]);
	
	//$('#modal_order_conponents').modal('toggle');
});