$("#sub").click( function(){
    
    var data = $("#myForm :input").serializeArray();
    
    $.post($("#myForm").attr("action"), data, function(info){
        $("#result").html(info);
    } );
    
     $("#myForm")[0].reset();
});

$("#myForm").submit( function(){
    return false;
});