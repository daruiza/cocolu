$('.alert-events').on("close.bs.alert", function () {
    $('.alert-events').hide();
    //eliminamos todo el contenido de eventos
    $('.alert-events .ul-content').html('');
    return false;
});