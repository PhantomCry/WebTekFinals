$("#sub1").click( function(){
    
    var data = $("#form1 :input").serializeArray();
    
    $.post($("#form1").attr("action"), data, function(info){
        $("#result").html(info);
    } );
});

$("#form1").submit( function(){
    return false;
});

$("#sub2").click( function(){
    
    var data = $("#form2 :input").serializeArray();
    
    $.post($("#form2").attr("action"), data, function(info){
        $("#result").html(info);
    } );
    
    $('#result').load('provider.php');
});

$("#form2").submit( function(){
    return false;
});


$("#sub3").click( function(){
    
    var data = $("#form3 :input").serializeArray();
    
    $.post($("#form3").attr("action"), data, function(info){
        $("#result").html(info);
    } );
    
    $('#result').load('units.php');
});

$("#form3").submit( function(){
    return false;
});