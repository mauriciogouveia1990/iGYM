// flags de validação de submit
var flagValida = 1;
var flagVa = 0;




//verifica se email ja existe ajax

$('#email').blur(function(){
    var email = $('#email').val();
    var url = $('#url').val();
 
    $.post(url+"utilizador/verificaEmailAjax", 
    {
        "email": email,
    }, 
    
    function(result){
        if(result==1){
            $("#erroEmail").html('<i class="fas fa-exclamation-circle"></i> Email ja existentente');
            flagValida = 0;
        }else{
            $("#erroEmail").html("");
            flagValida = 1;
        }
        
    }); 

});

//verifica se login ja existe ajax
$('#username').blur(function(){
    // $("#submit").attr("disabled", false);

    var username = $('#username').val();
    var url = $('#url').val();

    $.post(url+"utilizador/verificaEmailAjax", 
    {
        "username": username
    }, 
    
    function(result){
        if(result==1){
            $("#erroUsername").html('<i class="fas fa-exclamation-circle"></i> Username ja existentente');
            // $("#submit").attr("disabled", true);
            flagValida = 0;
        }else{
            $("#erroUsername").html("");
            flagValida = 1;
        }
        
    }); 

});

//verifica se cc ja existe ajax
$('#cc').blur(function(){
    // $("#submit").attr("disabled", false);
    var cc = $('#cc').val();
    var url = $('#url').val();

    $.post(url+"cliente/trataAjaxCliente", 
    {
        "cc": cc
    }, 
    
    function(result){
        if(result==1){
            $("#erroCC").html('<i class="fas fa-exclamation-circle"></i> Cartão de cidadão ja existentente');
            // $("#submit").attr("disabled", true);
            flagValida = 0;
        }else{
            $("#erroCC").html("");
            flagValida = 1;
        }
        
    }); 

});

//verifica se nif ja existe ajax
$('#nif').blur(function(){
    // $("#submit").attr("disabled", false);
    var nif = $('#nif').val();
    var url = $('#url').val();

    $.post(url+"cliente/trataAjaxCliente", 
    {
        "nif": nif
    }, 
    
    function(result){
        if(result==1){
            $("#erroNif").html('<i class="fas fa-exclamation-circle"></i> NIF ja existentente');
            // $("#submit").attr("disabled", true);
            flagValida = 0;
        }else{
            $("#erroNif").html("");
            flagValida = 1;
        }
        
    }); 

});

//event listener para verificar se passwords coincidem 
$('#confirmPasswordRegisto').blur(function(){
    var confirmPassword = $('#confirmPasswordRegisto').val();
    var passwordRegisto = $('#passwordRegisto').val();
    
    if(confirmPassword != passwordRegisto){
        $('#confirmPw').html('<i class="fas fa-exclamation-circle"></i> Passwords nao coincidem');
        flagValida = 0;
    }else{
        $('#confirmPw').html('');
        flagValida = 1;
    }
});

//cancela o submit do formulario se tiver algum erro 

$('#formRegisto').submit(function(event){
    if(flagValida!=1){
        event.preventDefault();
    }else if(flagVa == 0){
        //erro
    } 
    
});