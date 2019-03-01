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
		if(order_detail.products[obj][0].id == $("#modal_order_conponents #id_ingredient").val() && order_detail.products[obj][0].volume_sale == undefined ){
			order_detail.products[obj][0].volume_sale = $("input[name='volume_"+$("#modal_order_conponents #id_ingredient").val()+"']").val();
			
			//ingredients
			

		}
	}

	//limpiamos el array
	for(obj in order_detail.products) {
		if(order_detail.products[obj][0].volume_sale == undefined || order_detail.products[obj][0].volume_sale == 0){			
			order_detail.products.splice(obj, 1);
		}
	}

	


	//pintamos las ordenes

	
	$('#modal_order_conponents').modal('toggle');
});