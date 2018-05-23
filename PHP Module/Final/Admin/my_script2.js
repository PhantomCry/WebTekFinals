$("#sub2").click( function(){
    
    var data = $("#form2 :input").serializeArray();
    
    $.post($("#form2").attr("action"), data, function(info){
        $("#result").html(info);
    } );
});

$("#form2").submit( function(){
    return false;
});