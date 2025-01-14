function validarPassword(password) {
    let msg = "";

    // Verifica se a senha tem no mínimo 12 caracteres
    if (password.length < 12) {
        msg += "A senha deve ter no mínimo 12 caracteres.\n";
    }

    // Verifica se a senha tem pelo menos uma letra maiúscula
    if (!/[A-Z]/.test(password)) {
        msg += "A senha deve conter pelo menos uma letra maiúscula.\n";
    }

    // Verifica se a senha tem pelo menos uma letra minúscula
    if (!/[a-z]/.test(password)) {
        msg += "A senha deve conter pelo menos uma letra minúscula.\n";
    }

    // Verifica se a senha tem pelo menos um número
    if (!/[0-9]/.test(password)) {
        msg += "A senha deve conter pelo menos um número.\n";
    }

    // Verifica se a senha tem pelo menos um caractere especial
    if (!/[&*%$@!#]/.test(password)) {
        msg += "A senha deve conter pelo menos um caractere especial (como &,*,$,%).\n";
    }

    return msg;
}

function registaUser() {
    let username = $('#username').val();
    let password = $('#password').val();
    let pergunta = $('#pergunta').val();
    let resposta = $('#resposta').val();
    let id_tipo = $('#tpUser').val();

    // Chama a função de validação da senha
    let validationMessage = validarPassword(password);
    if (validationMessage) {
        // Se houver problemas, exibe o alerta e interrompe o processo de registro
        alerta("Erro na Senha", validationMessage, "error");
        return; // Impede o envio dos dados
    }

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("username", username);
    dados.append("pw", password);
    dados.append("pergunta", pergunta);
    dados.append("resposta", resposta);
    dados.append("id_tipo", id_tipo);

    $.ajax({
        url: "assets/controller/controllerLogin.php",
        method: "POST",
        data: dados,
        dataType: "html",
        cache: false,
        contentType: false,
        processData: false
    })
    
    .done(function(msg) {
        let obj = JSON.parse(msg);
        if (obj.flag) {
            alerta("Utilizador", obj.msg, "success");
        } else {
            alerta("Utilizador", obj.msg, "error");
        }
    })
    
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function login(){

    let dados = new FormData();
    dados.append("op", 2);
    dados.append("username", $('#usernameLogin').val());
    dados.append("pw", $('#passwordLogin').val());

    $.ajax({
    url: "assets/controller/controllerLogin.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        let obj = JSON.parse(msg);
        if(obj.flag){
            alerta("Utilizador",obj.msg,"success");
            
            setTimeout(function(){ 
                window.location.href = "home.php";
            }, 2000);

        }else{
            alerta("Utilizador",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });
}

function logout(){
    let dados = new FormData();
    dados.append("op", 3);

    $.ajax({
    url: "assets/controller/controllerLogin.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {


            alerta("Utilizador",msg,"success");
            
            setTimeout(function(){ 
                window.location.href = "index.html";
            }, 2000);
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}

function getTipos(){
    let dados = new FormData();
    dados.append('op', 4);
  
   
    $.ajax({
      url: "assets/controller/controllerLogin.php",
      method: "POST",
      data: dados,
      dataType: "html",
      cache: false,
      contentType: false,
      processData:false,
    })
    
    .done(function( msg ) {
  
     $('#tpUser').html(msg);

    })
    
    .fail(function( jqXHR, textStatus ) {
      alert( "Request failed: " + textStatus );
    });
  
  }



function alerta(titulo,msg,icon){
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: true,

      })
}

$(function() {
    getTipos();
});