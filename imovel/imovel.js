$(document).ready(function(){
    agendarVisita();
});

function agendarVisita(){
    $('#select-visita').change(function(){
        if($(this).val()=="oferta"){
            $("#label-visita").empty();
            $("#label-visita").append("Faça sua proposta");
            $("#input-visita").attr("placeholder", "Faça sua proposta pelo imóvel");
        } else {
                $("#label-visita").empty();
                $("#label-visita").append("Sua disponibilidade de horário");
                $("#input-visita").attr("placeholder", "Diga-nos sua disponibilidade de horário");
        } 
    });
}