function showNewLocation(){
    $("#crearUbicacion").slideToggle();
}

function showNewTipoPatron(){
    $("#crearTipoPatron").slideToggle();
}

function showNewTipoEquipo(){
    $("#crearTipoEquipo").slideToggle();
}

function checkCal(){
    if($("#cal").is(':checked')){
        $('#apreciacion').prop("disabled", false);
        $('#emp').prop("disabled", false);
    }else{
        $('#apreciacion').prop("disabled", true);
        $('#emp').prop("disabled", true);
    }
}

$(document).ready(function(){
    checkCal();
    $("#buscador").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".tablaBusqueda tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    $("#customFileLangHTML").on("change",function(){
        if($(this).val()!=null){
            $nombre=$(this).prop('files')[0].name;
            if($nombre.length>30){
                $nombre=$nombre.slice(0,28)+'...';
            }
            $("#customeFileLabel").text($nombre);
        }
    })
    $("#limpiarEquipo").click(function(){
        $("#customeFileLabel").text("Seleccionar Archivo");
        $('#apreciacion').prop("disabled", true);
        $('#emp').prop("disabled", true);
    })
    $("#cal").click(function(){
        checkCal();            
    })
        
});

	
