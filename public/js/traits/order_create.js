$('#modal_order_create').modal('toggle');

$('.option_add_product').on('click', function (e) {
	var datos = new Array();
	datos['id'] = this.id.split('_')[0];
	datos['store'] = this.id.split('_')[1];
	datos['name'] = this.id.split('_')[2];
	ajaxobject.peticionajax($('#form_add_product').attr('action'),datos,"table.returnAddProduct");				
});

$("#modal_order_conponents .btn-send").on('click', function (e) {

	//guardamos la orden en array de orders


	//pintamos las ordenes

	
	$('#modal_order_conponents').modal('toggle');
});