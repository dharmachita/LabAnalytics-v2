function showNewLocation(){
    $("#crearUbicacion").slideToggle();
}

function showNewTipoPatron(){
    $("#crearTipoPatron").slideToggle();
}

function showNewTipoEquipo(){
    $("#crearTipoEquipo").slideToggle();
}

$(document).ready(function(){
    $("#buscador").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".tablaBusqueda tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});

	
