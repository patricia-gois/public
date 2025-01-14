function validarPassword(password) {
    let msg = "";

    // minimun of 8 characters
    if (password.length < 8) {
        msg += "A senha deve ter no mínimo 8 caracteres.\n";
    }

    if (!/[A-Z]/.test(password)) {
        msg += "A senha deve conter pelo menos uma letra maiúscula.\n";
    }

    if (!/[a-z]/.test(password)) {
        msg += "A senha deve conter pelo menos uma letra minúscula.\n";
    }

    if (!/[0-9]/.test(password)) {
        msg += "A senha deve conter pelo menos um número.\n";
    }

    if (!/[&*%$@!#]/.test(password)) {
        msg += "A senha deve conter pelo menos um caractere especial (como &,*,$,%).\n";
    }

    return msg;
}

function registUser() {
    let nome = $('#username').val();
    let morada = $('#moradaUtilizador').val();
    let telefone = $('#telefoneUtilizador').val();
    let email = $('#emailUtilizador').val();
    let password = $('#password').val();
    let id_tipo = $('#tpUser').val();

    // validates password
    let validationMessage = validarPassword(password);
    if (validationMessage) {
        //if anything wrong, alert and block the process
        alerta("Erro na Senha", validationMessage, "error");
        return; // block data sending
    }

    let dados = new FormData();
    dados.append("op", 1);
    dados.append("nome", nome);
    dados.append("morada", morada);
    dados.append("telefone", telefone);
    dados.append("email", email);
    dados.append("password", password);
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




function login() { 
    let dados = new FormData();
    dados.append("op", 2);
    dados.append("nome", $('#usernameLogin').val());
    dados.append("password", $('#passwordLogin').val());

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
        try {
            let obj = JSON.parse(msg);
            if (obj.flag) {
                alerta("Utilizador", obj.msg, "success");
                
                setTimeout(function() { 
                    window.location.href = "home.php";
                }, 2000);

            } else {
                alerta("Utilizador", obj.msg, "error");    
            }
        } catch (e) {
            console.error("Erro ao processar resposta JSON:", e, msg);
            alerta("Erro", "Resposta inválida do servidor", "error");
        }
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
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
    .done(function(msg) {
        let obj = JSON.parse(msg); // Parse the JSON response

        if (obj.flag) {
            alerta("Utilizador", obj.msg, "success");
            setTimeout(function(){ 
                window.location.href = "index.html"; // Redirect after logout
            }, 2000);
        } else {
            alerta("Utilizador", obj.msg, "error");
        }
    })
    .fail(function(jqXHR, textStatus) {
        alert("Request failed: " + textStatus);
    });
}

function getTypes(){
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

  function listaLogins(){

    let dados = new FormData();
    dados.append ('op', 5);
   
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
        $('#listaLogins').html(msg);
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

  //DataTables
  new DataTable('#listagemLogins', {
    layout: {
        topStart: 'search',
        topEnd: null
    }
  });

$(function() {
    getTypes();
    listaLogins();
});